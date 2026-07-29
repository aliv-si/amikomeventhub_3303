@extends('layout.admin', ['title' => 'Manajemen Voucher'])

@section('content')
<main class="w-full p-10 overflow-y-auto">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Voucher & Diskon</h1>
            <p class="text-slate-500 font-medium">Kelola kode kupon diskon untuk event Anda.</p>
        </div>
        <a href="{{ route('admin.vouchers.create') }}" class="flex items-center gap-2 px-5 py-2.5 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Voucher Baru
        </a>
    </header>

    @if(session('success'))
    <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-600 rounded-xl font-bold text-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white border border-slate-100 rounded-[2.5rem] overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Kode Voucher</th>
                        <th class="px-8 py-4">Event Terkait</th>
                        <th class="px-8 py-4">Nilai Diskon</th>
                        <th class="px-8 py-4">Penggunaan</th>
                        <th class="px-8 py-4">Berlaku Sampai</th>
                        <th class="px-8 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y border-t border-slate-100">
                    @forelse($vouchers as $voucher)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-8 py-6">
                            <span class="font-mono font-bold px-3 py-1 bg-indigo-50 text-indigo-600 rounded-lg text-sm border border-indigo-100">
                                {{ $voucher->code }}
                            </span>
                        </td>
                        <td class="px-8 py-6 font-medium text-slate-700">
                            {{ $voucher->event->title ?? '-' }}
                        </td>
                        <td class="px-8 py-6">
                            @if($voucher->discount_type === 'nominal')
                                <span class="font-bold text-slate-800">Rp {{ number_format($voucher->discount_value, 0, ',', '.') }}</span>
                            @else
                                <span class="font-bold text-slate-800">{{ $voucher->discount_value }}%</span>
                            @endif
                        </td>
                        <td class="px-8 py-6 text-sm text-slate-500">
                            {{ $voucher->used_count }} / {{ $voucher->max_uses ?? '∞' }}
                        </td>
                        <td class="px-8 py-6 text-sm text-slate-500">
                            {{ $voucher->valid_until ? $voucher->valid_until->format('d M Y, H:i') : 'Tanpa batas' }}
                        </td>
                        <td class="px-8 py-6 text-center">
                            <form action="{{ route('admin.vouchers.destroy', $voucher->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus voucher ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-10 text-center text-slate-500 font-medium">Belum ada data voucher.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection
