<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class   CheckoutController extends Controller
{
    public function create(Event $event)
    {
        // Mengambil daftar kategori untuk keperluan menu footer

        $categories = \App\Models\Category::all();
        $activeTier = $event->activeTier();

        return view('checkout.create', compact('event', 'categories', 'activeTier'));
    }

    public function checkVoucher(Request $request)
    {
        $code = $request->code;
        $eventId = $request->event_id;
        $price = $request->price;

        $voucher = \App\Models\Voucher::where('code', strtoupper($code))->first();

        if (!$voucher) {
            return response()->json(['valid' => false, 'message' => 'Kode voucher tidak ditemukan.']);
        }

        // Voucher event-specific
        if ($voucher->event_id !== null && $voucher->event_id != $eventId) {
            return response()->json(['valid' => false, 'message' => 'Voucher ini tidak berlaku untuk event ini.']);
        }

        if ($voucher->valid_until && $voucher->valid_until < now()) {
            return response()->json(['valid' => false, 'message' => 'Kode voucher sudah kadaluarsa.']);
        }

        if ($voucher->max_uses && $voucher->used_count >= $voucher->max_uses) {
            return response()->json(['valid' => false, 'message' => 'Kuota voucher sudah habis.']);
        }

        $discount = 0;
        if ($voucher->discount_type === 'nominal') {
            $discount = $voucher->discount_value;
        } else {
            $discount = ($price * $voucher->discount_value) / 100;
        }

        if ($discount > $price) {
            $discount = $price;
        }

        return response()->json([
            'valid' => true,
            'code' => $voucher->code,
            'discount_amount' => $discount,
            'discount_formatted' => number_format($discount, 0, ',', '.')
        ]);
    }

    public function store(Request $request, Event $event)
    {
        // 1. Validasi Input Kredensial Pelanggan

        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
        ]);

        // 2. Cegah checkout jika tiket habis

        if ($event->stock <= 0) {
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Maaf, Tiket untuk event ini sudah habis.']);
            }
            return back()->with('error', 'Maaf, Tiket untuk event ini sudah habis.');
        }

        // 3. Generate Kode TRX (Unik)

        $orderId = 'TRX-' . date('Hi') . '-' . Str::random(5);

        $activeTier = $event->activeTier();
        $basePrice = $activeTier ? $activeTier->price : $event->price;
        $totalPrice = $basePrice + 5000;
        
        $discountAmount = 0;
        $voucherId = null;

        if ($request->filled('voucher_code')) {
            $voucher = \App\Models\Voucher::where('code', strtoupper($request->voucher_code))->first();
            if ($voucher && (!$voucher->event_id || $voucher->event_id == $event->id)) {
                if (!$voucher->valid_until || $voucher->valid_until >= now()) {
                    if (!$voucher->max_uses || $voucher->used_count < $voucher->max_uses) {
                        $voucherId = $voucher->id;
                        if ($voucher->discount_type === 'nominal') {
                            $discountAmount = $voucher->discount_value;
                        } else {
                            $discountAmount = ($basePrice * $voucher->discount_value) / 100;
                        }
                        if ($discountAmount > $basePrice) {
                            $discountAmount = $basePrice;
                        }
                        $totalPrice -= $discountAmount;
                    }
                }
            }
        }

        // 4. Merekam Transaksi ke Database
        $transaction = Transaction::create([
            'order_id' => $orderId,
            'event_id' => $event->id,
            'event_ticket_tier_id' => $activeTier ? $activeTier->id : null,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'total_price' => $totalPrice,
            'voucher_id' => $voucherId,
            'discount_amount' => $discountAmount,
            'status' => 'pending',
        ]);

        // --- INTEGRASI SNAP MIDTRANS ---

        // Konfigurasi Kredensial Environment Midtrans
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false; // Mode Sandbox!
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Susun Paket Array Data Transaksi
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $request->customer_name,
                'email' => $request->customer_email,
                'phone' => $request->customer_phone,
            ],
        ];

        try {
            // Perintah Tembak Generate Snap Token
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            // Update rekaman kita bahwa transaksi terkait sudah memiliki id token pelunasan
            $transaction->update(['snap_token' => $snapToken]);

            // 5. Arahakan ke rute dummy halaman sukses sementara
            // (Akan kita ubah next lecture)
            if ($request->ajax() || $request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'order_id' => $orderId,
                    'snap_token' => $snapToken
                ]);
            }

            // Redirect ke halaman antarmuka pembayaran final pelanggan
            return redirect()->route('checkout.payment', $transaction->order_id);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran jaringan: ' . $e->getMessage());
        }

        return redirect('/');
    }

    public function payment(Request $request, $orderId)
    {
        $transaction = Transaction::where('order_id', $orderId)->firstOrFail();

        return view('checkout.payment', compact('transaction'));
    }

    public function success($order_id)
    {
        // Mengambil daftar kategori untuk keperluan menu footer
        $categories = \App\Models\Category::all();

        $transaction = Transaction::with('event')->where('order_id', $order_id)->firstOrFail();
        
        // Konfigurasi Midtrans untuk mengecek status transaksi langsung ke API
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        try {
            // Mengecek status pesanan secara mandiri (Bypass)
            $status = \Midtrans\Transaction::status($order_id);
            
            if ($status) {
                // Mengambil nilai status transaksi
                $trx_status = is_array($status) ? ($status['transaction_status'] ?? '') : ($status->transaction_status ?? '');
                
                // Jika API Midtrans mengonfirmasi bahwa transaksi telah berhasil (settlement / capture)
                if (in_array($trx_status, ['settlement', 'capture'])) {
                    // Hanya lakukan update jika status di database lokal masih 'pending' (indikasi Webhook tidak masuk)
                    if (strtolower($transaction->status) === 'pending') {
                        $transaction->update(['status' => 'success']);
                        
                        if ($transaction->event && $transaction->event->stock > 0) {
                            $transaction->event->stock -= 1;
                            $transaction->event->save();
                            
                            // Deduct tier stock if applicable
                            if ($transaction->event_ticket_tier_id) {
                                $tier = \App\Models\EventTicketTier::find($transaction->event_ticket_tier_id);
                                if ($tier && $tier->stock > 0) {
                                    $tier->stock -= 1;
                                    $tier->save();
                                }
                            }

                            // Increment voucher used count
                            if ($transaction->voucher_id) {
                                $voucher = \App\Models\Voucher::find($transaction->voucher_id);
                                if ($voucher) {
                                    $voucher->used_count += 1;
                                    $voucher->save();
                                }
                            }
                            
                            try {
                                \Illuminate\Support\Facades\Mail::to($transaction->customer_email)
                                    ->send(new \App\Mail\EventTicketMail($transaction));
                            } catch (\Exception $e) {
                                \Log::error('Gagal mengirim email E-Ticket secara manual (Bypass): ' . $e->getMessage());
                            }
                        }
                    }
                }
            }
        } catch (\Exception $e) {
            // Jika terjadi error dari API Midtrans (transaksi tidak valid), kembalikan ke beranda
            return redirect()->route('home')->with('error', 'Transaksi tidak ditemukan atau gagal diproses oleh sistem pembayaran.');
        }

        return view('checkout.success', compact('transaction', 'categories'));
    }
}
