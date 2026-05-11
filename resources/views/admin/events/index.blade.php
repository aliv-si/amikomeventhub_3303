@extends('layout.admin', ['title' => 'Kelola Event'])

@section('content')
<main class="flex-1 p-10 overflow-y-auto">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Kelola Event</h1>
            <p class="text-slate-500 font-medium">Buat dan atur acara seru Anda di sini.</p>
        </div>
        <a href="{{ route('admin.event.create') }}"
            class="flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="4" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Event
        </a>
    </header>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm">
        <form id="filter-form" action="{{ route('admin.event') }}" method="GET" class="px-8 py-6 bg-slate-50/50 border-b flex gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari event..."
                class="flex-1 px-5 py-3 rounded-xl border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
            <!-- Custom Animated Dropdown -->
            <div class="relative w-64" id="custom-category-select">
                <input type="hidden" name="category_id" id="category_input" value="{{ request('category_id') }}">

                <button type="button" onclick="toggleDropdown()" id="dropdown-button"
                    class="w-full flex justify-between items-center px-5 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 font-medium hover:border-indigo-300 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 outline-none transition-all shadow-sm">
                    @php
                    $selectedName = 'Semua Kategori';
                    if(request('category_id')) {
                    $cat = $categories->firstWhere('id', request('category_id'));
                    if($cat) $selectedName = $cat->name;
                    }
                    @endphp
                    <span id="dropdown-selected-text" class="truncate">{{ $selectedName }}</span>
                    <svg id="dropdown-icon" class="w-5 h-5 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <!-- Animasi Dropdown: awalnya invisible, transparan, dan sedikit naik ke atas -->
                <div id="dropdown-menu"
                    class="absolute z-50 w-full mt-2 bg-white border border-slate-100 rounded-xl shadow-2xl opacity-0 invisible -translate-y-2 transition-all duration-300 overflow-hidden origin-top">
                    <ul class="max-h-60 overflow-y-auto py-1 divide-y divide-slate-50">
                        <li onclick="selectCategory('', 'Semua Kategori')" class="px-5 py-3 hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer transition-colors text-slate-600 font-medium text-sm">Semua Kategori</li>
                        @foreach($categories as $category)
                        <li onclick="selectCategory('{{ $category->id }}', '{{ $category->name }}')" class="px-5 py-3 hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer transition-colors text-slate-600 font-medium text-sm">{{ $category->name }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </form>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                    <tr>
                        <th class="px-8 py-4 w-16">No</th>
                        <th class="px-8 py-4">Poster</th>
                        <th class="px-8 py-4">Event</th>
                        <th class="px-8 py-4">Kategori</th>
                        <th class="px-8 py-4">Harga / Stok</th>
                        <th class="px-8 py-4">Aksi</th>
                    </tr>
                </thead>
                <tbody id="events-table-body" class="divide-y border-t transition-opacity duration-300">
                    @forelse ($events as $index => $event)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-8 py-6 font-bold text-slate-400">{{ $index + 1 }}</td>
                        <td class="px-8 py-6">
                            <img src="{{ asset('storage/' . $event->poster_path) }}" class="w-16 h-20 rounded-xl object-cover shadow-sm">
                        </td>
                        <td class="px-8 py-6">
                            <p class="font-black text-slate-800 mb-1">{{ $event->title }}</p>
                            <p class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($event->date)->translatedFormat('d M Y') }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <p class="text-xs text-slate-400">{{ $event->category->name ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="font-bold text-indigo-600">
                                {{ $event->price > 0 ? 'Rp ' . number_format($event->price, 0, ',', '.') : 'Gratis' }}
                            </p>
                            <p class="text-xs text-slate-400">Kuota: {{ $event->stock }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.event.edit', $event->id) }}"
                                    class="p-2.5 bg-indigo-50 text-indigo-600 rounded-xl hover:bg-indigo-600 hover:text-white transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.event.delete', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2.5 bg-rose-50 text-rose-600 rounded-xl hover:bg-rose-600 hover:text-white transition">
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
                        <td colspan="5" class="px-8 py-10 text-center text-slate-500 font-medium">Event tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<script>
    // Logika Custom Dropdown Animasi
    const dropdownMenu = document.getElementById('dropdown-menu');
    const dropdownIcon = document.getElementById('dropdown-icon');
    const dropdownText = document.getElementById('dropdown-selected-text');
    const categoryInput = document.getElementById('category_input');

    function toggleDropdown() {
        // Toggle animasi (muncul/hilang dan geser naik/turun)
        dropdownMenu.classList.toggle('opacity-0');
        dropdownMenu.classList.toggle('invisible');
        dropdownMenu.classList.toggle('-translate-y-2');

        // Memutar ikon panah (chevron)
        dropdownIcon.classList.toggle('rotate-180');
    }

    function selectCategory(id, name) {
        // Set value ke hidden input
        categoryInput.value = id;
        // Ubah teks yang tampil di tombol
        dropdownText.textContent = name;
        // Tutup dropdown
        toggleDropdown();
        // Lakukan filter AJAX (tanpa loading halaman)
        fetchFilteredData();
    }

    // Tangani form submit (misal ditekan Enter di input) agar tidak reload halaman
    document.getElementById('filter-form').addEventListener('submit', function(e) {
        e.preventDefault();
        fetchFilteredData();
    });

    // Fitur premium: fetch data tabel tanpa reload halaman (AJAX)
    function fetchFilteredData() {
        const form = document.getElementById('filter-form');
        const url = new URL(form.action);
        const params = new URLSearchParams(new FormData(form));
        url.search = params.toString();

        // Beri efek loading tabel memudar (transparan)
        const tbody = document.getElementById('events-table-body');
        tbody.classList.add('opacity-30');

        fetch(url)
            .then(response => response.text())
            .then(html => {
                // Update URL browser diam-diam (agar link tetap akurat jika di-copy)
                window.history.pushState({}, '', url);

                // Ekstrak bagian dalam tabel (<tbody>) dari HTML mentah yang dikembalikan
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTbody = doc.getElementById('events-table-body');

                if (newTbody) {
                    tbody.innerHTML = newTbody.innerHTML;
                }

                // Hilangkan efek loading
                tbody.classList.remove('opacity-30');
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
                tbody.classList.remove('opacity-30');
            });
    }

    // Tutup dropdown jika user klik di luar area kotak dropdown
    document.addEventListener('click', function(event) {
        const selectContainer = document.getElementById('custom-category-select');
        // Pastikan klik terjadi di luar kontainer DAN dropdown sedang terbuka
        if (!selectContainer.contains(event.target) && !dropdownMenu.classList.contains('invisible')) {
            toggleDropdown();
        }
    });
</script>
@endsection