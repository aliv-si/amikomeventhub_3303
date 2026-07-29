<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VoucherController extends Controller
{

    public function index()
    {
        $query = \App\Models\Voucher::with('event')->latest();

        if (auth()->user()->role === 'organizer') {
            $query->whereHas('event', function($q) {
                $q->where('organizer_id', auth()->id());
            });
        }

        $vouchers = $query->get();
        return view('admin.vouchers.index', compact('vouchers'));
    }

    public function create()
    {
        // Get events owned by the user (or all if admin)
        $query = \App\Models\Event::latest();
        if (auth()->user()->role === 'organizer') {
            $query->where('organizer_id', auth()->id());
        }
        $events = $query->get();

        return view('admin.vouchers.create', compact('events'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'code' => 'required|string|unique:vouchers,code|max:50',
            'discount_type' => 'required|in:nominal,percentage',
            'discount_value' => 'required|integer|min:1',
            'max_uses' => 'nullable|integer|min:1',
            'valid_until' => 'nullable|date',
        ]);

        // Verify ownership
        $event = \App\Models\Event::findOrFail($request->event_id);
        if (auth()->user()->role === 'organizer' && $event->organizer_id !== auth()->id()) {
            abort(403);
        }

        \App\Models\Voucher::create([
            'event_id' => $request->event_id,
            'code' => strtoupper($request->code),
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'max_uses' => $request->max_uses,
            'valid_until' => $request->valid_until,
        ]);

        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dibuat!');
    }

    public function destroy(string $id)
    {
        $voucher = \App\Models\Voucher::findOrFail($id);
        
        if (auth()->user()->role === 'organizer' && $voucher->event->organizer_id !== auth()->id()) {
            abort(403);
        }

        $voucher->delete();
        return redirect()->route('admin.vouchers.index')->with('success', 'Voucher berhasil dihapus!');
    }
}
