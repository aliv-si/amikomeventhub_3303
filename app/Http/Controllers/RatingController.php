<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Menyimpan rating (1-5) untuk transaksi tertentu.
     */
    public function store(Request $request, $order_id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:1000',
        ]);

        $transaction = Transaction::where('order_id', $order_id)->firstOrFail();

        // Hanya transaksi yang sudah berhasil (settlement/success) yang boleh dirating
        if (!in_array(strtolower($transaction->status), ['success', 'settlement'])) {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi belum lunas, tidak dapat memberikan rating.',
            ], 403);
        }

        // Cegah rating duplikat
        if ($transaction->rating !== null) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memberikan rating sebelumnya.',
            ], 409);
        }

        $transaction->update([
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Terima kasih atas rating dan ulasan Anda!',
            'rating' => $request->rating,
        ]);
    }
}
