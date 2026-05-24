@extends('layout.admin', ['title' => 'Kelola Partner'])

@section('content')
<main class="flex-1 p-10 overflow-y-auto">

    {{-- Toast Notifikasi --}}
    @if(session('success'))
    <div id="toast-notification" class="fixed bottom-6 right-6 z-[999] flex items-center gap-3 px-6 py-4 bg-emerald-600 text-white rounded-2xl shadow-2xl shadow-emerald-200 translate-x-[120%] transition-transform duration-500 ease-out">
        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="font-bold text-sm">{{ session('success') }}</span>
        <button onclick="dismissToast()" class="ml-2 hover:bg-white/20 rounded-lg p-1 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div id="toast-notification" class="fixed bottom-6 right-6 z-[999] flex items-center gap-3 px-6 py-4 bg-rose-600 text-white rounded-2xl shadow-2xl shadow-rose-200 translate-x-[120%] transition-transform duration-500 ease-out">
        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="font-bold text-sm">{{ session('error') }}</span>
        <button onclick="dismissToast()" class="ml-2 hover:bg-white/20 rounded-lg p-1 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    @endif
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Kelola Partner</h1>
            <p class="text-slate-500 font-medium">Buat dan atur partner Anda di sini.</p>
        </div>
        <a href="{{ route('admin.partner.create') }}"
            class="flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Partner
        </a>
    </header>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-8 py-6 bg-slate-50/50 border-b">
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4 w-16">No</th>
                        <th class="px-8 py-4 w-32">Logo</th>
                        <th class="px-8 py-4">Nama Partner</th>
                        <th class="px-8 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody id="partners-table-body" class="divide-y border-t transition-opacity duration-300">
                    @forelse($partners as $index => $partner)
                    <tr class="hover:bg-indigo-50/50 transition cursor-pointer group">
                        <td class="px-8 py-6 font-bold text-slate-400">{{ $index + 1 }}</td>
                        <td class="px-8 py-6">
                            @if($partner->logo)
                            <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}" class="h-10 w-10 aspect-square object-cover rounded-xl">
                            @else
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 font-bold text-sm">
                                {{ strtoupper(substr($partner->name, 0, 2)) }}
                            </div>
                            @endif
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-black text-slate-800 group-hover:text-indigo-600 transition">{{ $partner->name }}</p>
                        </td>
                        <td class="px-8 py-6" onclick="event.stopPropagation()">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.partner.edit', $partner->id) }}" class="p-2 text-slate-400 hover:text-amber-600 hover:bg-amber-50 rounded-xl transition" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.partner.delete', $partner->id) }}" method="POST" onsubmit="return handleDelete(event)" class="delete-form inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2.5 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-10 text-center text-slate-500 font-medium">Belum ada partner yang ditambahkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    // Logika Toast Notifikasi
    const toast = document.getElementById('toast-notification');
    if (toast) {
        // Masukkan toast dari kanan dengan animasi slide-in
        setTimeout(() => {
            toast.classList.remove('translate-x-[120%]');
            toast.classList.add('translate-x-0');
        }, 100);

        // Otomatis hilangkan setelah 4 detik
        setTimeout(() => {
            dismissToast();
        }, 4000);
    }

    function dismissToast() {
        const toast = document.getElementById('toast-notification');
        if (toast) {
            toast.classList.remove('translate-x-0');
            toast.classList.add('translate-x-[120%]');
            // Hapus elemen setelah animasi selesai
            setTimeout(() => toast.remove(), 500);
        }
    }

    // Logika Hapus Partner
    function handleDelete(e) {
        if (!confirm('Apakah Anda yakin ingin menghapus partner ini?')) {
            e.preventDefault();
            return false;
        }

        const tbody = document.getElementById('partners-table-body');
        tbody.classList.add('opacity-30');
        tbody.style.pointerEvents = 'none';

        return true;
    }
</script>
@endsection