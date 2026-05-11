@extends('layout.admin', ['title' => 'Edit Event'])


@section('content')
<main class="w-full p-10 overflow-y-auto">
    <header class="mb-10">
        <h1 class="text-3xl font-black">Edit Event</h1>
        <p class="text-slate-500 font-medium">Perbarui informasi event <span class="text-indigo-600">"{{ $event->title }}"</span></p>
    </header>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm max-w-4xl">
        <form action="{{ route('admin.event.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Judul Event</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}"
                        class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none transition" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <div class="relative w-full" id="custom-category-select">
                        <input type="hidden" name="category_id" id="category_input" value="{{ old('category_id', $event->category_id) }}" required>
                        <button type="button" onclick="toggleDropdown()" id="dropdown-button"
                            class="w-full flex justify-between items-center px-5 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 font-medium hover:border-indigo-300 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 outline-none transition-all">
                            @php
                            $selectedName = 'Pilih Kategori';
                            $currentId = old('category_id', $event->category_id);
                            if($currentId) {
                                $cat = $categories->firstWhere('id', $currentId);
                                if($cat) $selectedName = $cat->name;
                            }
                            @endphp
                            <span id="dropdown-selected-text" class="truncate">{{ $selectedName }}</span>
                            <svg id="dropdown-icon" class="w-5 h-5 text-slate-400 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <div id="dropdown-menu"
                            class="absolute z-50 w-full mt-2 bg-white border border-slate-100 rounded-xl shadow-2xl opacity-0 invisible -translate-y-2 transition-all duration-300 overflow-hidden origin-top">
                            <ul class="max-h-60 overflow-y-auto py-1 divide-y divide-slate-50">
                                @foreach($categories as $category)
                                <li onclick="selectCategory('{{ $category->id }}', '{{ $category->name }}')" class="px-5 py-3 hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer transition-colors text-slate-600 font-medium text-sm">{{ $category->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Tanggal Event</label>
                        <input type="date" name="date" value="{{ old('date', date('Y-m-d', strtotime($event->date))) }}" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none cursor-pointer" required>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Waktu Event</label>
                        <input type="time" name="time" value="{{ old('time', date('H:i', strtotime($event->date))) }}" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none cursor-pointer" required>
                    </div>
                </div>


                <div class="col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none" required>{{ old('description', $event->description) }}</textarea>
                </div>


                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $event->price) }}" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none" required>
                </div>


                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Stok Tiket</label>
                    <input type="number" name="stock" value="{{ old('stock', $event->stock) }}" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none" required>
                </div>


                <div class="col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi</label>
                    <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none" required>
                </div>


                <div class="col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Poster Event</label>
                    <div class="flex items-start gap-6 p-4 border border-dashed border-slate-200 rounded-2xl bg-slate-50/50">
                        <div class="shrink-0 text-center">
                            <!-- <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Poster Saat Ini</p> -->
                            <img src="{{ asset('storage/'.$event->poster_path) }}" class="w-24 h-32 rounded-xl object-cover shadow-md border-2 border-white">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="poster" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="text-xs text-slate-500 mt-3 leading-relaxed">Pilih file baru jika ingin mengganti poster. Kosongkan jika tidak ingin mengubah gambar.</p>
                        </div>
                    </div>
                </div>
            </div>


            <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.event') }}" class="px-6 py-3 font-bold text-slate-400 hover:text-slate-600 transition">Batal</a>
                <button type="submit" class="px-10 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transform active:scale-95 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</main>

<script>
    const dropdownMenu = document.getElementById('dropdown-menu');
    const dropdownIcon = document.getElementById('dropdown-icon');
    const dropdownText = document.getElementById('dropdown-selected-text');
    const categoryInput = document.getElementById('category_input');

    function toggleDropdown() {
        dropdownMenu.classList.toggle('opacity-0');
        dropdownMenu.classList.toggle('invisible');
        dropdownMenu.classList.toggle('-translate-y-2');
        dropdownIcon.classList.toggle('rotate-180');
    }

    function selectCategory(id, name) {
        categoryInput.value = id;
        dropdownText.textContent = name;
        toggleDropdown();
    }

    document.addEventListener('click', function(event) {
        const selectContainer = document.getElementById('custom-category-select');
        if (!selectContainer.contains(event.target) && !dropdownMenu.classList.contains('invisible')) {
            toggleDropdown();
        }
    });
</script>
@endsection