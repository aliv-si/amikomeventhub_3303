@extends('layout.admin', ['title' => 'Buat Voucher Baru'])

@section('content')
<main class="w-full p-10 overflow-y-auto">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Buat Voucher Baru</h1>
            <p class="text-slate-500 font-medium">Buat kode diskon baru untuk menarik lebih banyak pembeli.</p>
        </div>
        <a href="{{ route('admin.vouchers.index') }}" class="flex items-center gap-2 px-5 py-2.5 text-slate-600 rounded-xl font-bold hover:text-indigo-600 active:scale-95 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </header>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm w-full">
        @if ($errors->any())
        <div class="mb-8 p-4 bg-rose-50 border border-rose-200 rounded-xl">
            <ul class="list-disc list-inside text-sm text-rose-600 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.vouchers.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Event Terkait</label>
                    <select name="event_id" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none bg-white" required>
                        <option value="">-- Pilih Event --</option>
                        @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>{{ $event->title }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kode Voucher</label>
                    <input type="text" name="code" value="{{ old('code') }}" placeholder="Contoh: MAHASISWA50" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none uppercase font-mono" required>
                </div>

                <div class="col-span-2 md:col-span-1 flex gap-4">
                    <div class="w-1/3">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tipe Diskon</label>
                        <select name="discount_type" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none bg-white" required>
                            <option value="nominal" {{ old('discount_type') == 'nominal' ? 'selected' : '' }}>Nominal (Rp)</option>
                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Persentase (%)</option>
                        </select>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Nilai Diskon</label>
                        <input type="number" name="discount_value" value="{{ old('discount_value') }}" placeholder="Contoh: 50000 atau 50" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Batas Penggunaan (Kuota)</label>
                    <input type="number" name="max_uses" value="{{ old('max_uses') }}" placeholder="Kosongkan jika tanpa batas" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none">
                    <p class="text-xs text-slate-500 mt-1">Kosongkan jika voucher bisa dipakai oleh siapa saja tanpa batas kuota klaim.</p>
                </div>

                <div class="col-span-2 md:col-span-1">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Berlaku Sampai Tanggal & Waktu</label>
                    <input type="datetime-local" name="valid_until" value="{{ old('valid_until') }}" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none">
                    <p class="text-xs text-slate-500 mt-1">Kosongkan jika voucher berlaku selamanya.</p>
                </div>
            </div>

            <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.vouchers.index') }}" class="px-6 py-3 font-bold text-slate-400 hover:text-slate-600 transition duration-300">Batal</a>
                <button type="submit" class="px-10 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transform active:scale-95 transition duration-300">
                    Simpan Voucher
                </button>
            </div>
        </form>
    </div>
</main>
@endsection
