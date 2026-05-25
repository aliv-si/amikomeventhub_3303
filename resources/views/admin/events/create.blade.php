@extends('layout.admin', ['title' => 'Tambah Event'])

@section('content')
<main class="w-full p-10 overflow-y-auto">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Tambah Event</h1>
            <p class="text-slate-500 font-medium">Isi detail event baru dengan lengkap.</p>
        </div>
        <a href="{{ route('admin.event') }}"
            class="flex items-center gap-2 px-5 py-2.5 text-slate-600 rounded-xl font-bold hover:text-indigo-600 active:scale-95 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </header>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 p-10 shadow-sm w-full">
        {{-- Tampilkan error validasi jika ada --}}
        @if ($errors->any())
        <div class="mb-8 p-4 bg-rose-50 border border-rose-200 rounded-xl">
            <div class="flex items-center gap-2 mb-2">
                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="font-bold text-rose-700 text-sm">Terdapat kesalahan pada input Anda:</p>
            </div>
            <ul class="list-disc list-inside text-sm text-rose-600 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div class="grid grid-cols-2 gap-6">
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Judul Event</label>
                    <input type="text" name="title" class="w-full px-5 py-3 rounded-xl border border-slate-200 focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Kategori</label>
                    <div class="relative w-full" id="custom-category-select">
                        <input type="hidden" name="category_id" id="category_input" value="{{ old('category_id') }}" required>
                        <button type="button" onclick="toggleDropdown()" id="dropdown-button"
                            class="w-full flex justify-between items-center px-5 py-3 rounded-xl border border-slate-200 bg-white text-slate-700 font-medium hover:border-indigo-300 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 outline-none transition-all">
                            @php
                            $selectedName = 'Pilih Kategori';
                            if(old('category_id')) {
                                $cat = $categories->firstWhere('id', old('category_id'));
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
                                <li onclick="selectCategory('', 'Pilih Kategori')" class="px-5 py-3 hover:bg-indigo-50 hover:text-indigo-600 cursor-pointer transition-colors text-slate-600 font-medium text-sm">Pilih Kategori</li>
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
                        <input type="date" name="date" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none cursor-pointer" required>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Waktu Event</label>
                        <input type="time" name="time" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none cursor-pointer" required>
                    </div>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Deskripsi</label>
                    <textarea name="description" rows="4" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none" required></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Harga (Rp)</label>
                    <input type="number" name="price" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-2">Stok Tiket</label>
                    <input type="number" name="stock" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none" required>
                </div>
                <div class="col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Lokasi</label>
                    <input type="text" name="location" class="w-full px-5 py-3 rounded-xl border border-slate-200 outline-none" required>
                </div>
                <div class="col-span-2">
                    <span class="block text-sm font-bold text-slate-700 mb-2">Upload Poster</span>
                    
                    <input id="poster" name="poster" type="file" class="sr-only" accept="image/*" onchange="previewPoster(event)" required>
                    
                    <!-- Dropzone -->
                    <label id="dropzone" for="poster" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-[1.5rem] hover:border-indigo-400 transition-colors cursor-pointer relative">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <span class="font-bold text-indigo-600 hover:text-indigo-500">Pilih file poster</span>
                                <!-- <p class="pl-1">atau seret dan lepas</p> -->
                            </div>
                            <p class="text-xs text-slate-400">PNG, JPG, JPEG up to 2MB</p>
                        </div>
                    </label>
                    
                    <!-- Image preview container -->
                    <div id="preview-container" class="mt-1 hidden">
                        <div class="flex items-center gap-6 p-4 border border-slate-200 rounded-[1.5rem] bg-slate-50/50">
                            <img id="poster-preview" src="#" alt="Pratinjau Poster" class="w-24 h-32 object-cover rounded-xl shadow-md border-2 border-white">
                            <div class="space-y-2">
                                <p class="text-sm font-bold text-slate-700 truncate max-w-xs" id="file-name-text">Nama File</p>
                                <button type="button" onclick="removePosterPreview()" class="flex items-center gap-2 px-4 py-2 bg-rose-50 text-rose-600 rounded-xl text-xs font-bold hover:bg-rose-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Ganti Gambar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-slate-100">
                <a href="{{ route('admin.event') }}" class="px-6 py-3 font-bold text-slate-400 hover:text-slate-600 transition duration-300">Batal</a>
                <button type="submit" class="px-10 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transform active:scale-95 transition duration-300">
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

    function previewPoster(event) {
        const input = event.target;
        const preview = document.getElementById('poster-preview');
        const container = document.getElementById('preview-container');
        const dropzone = document.getElementById('dropzone');
        const fileNameText = document.getElementById('file-name-text');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileSizeInMB = file.size / (1024 * 1024);
            
            // Verifikasi ukuran file (maksimal 2MB)
            if (fileSizeInMB > 2) {
                alert('Ukuran file poster tidak boleh lebih dari 2MB!');
                input.value = ''; // Reset input file
                return;
            }

            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                fileNameText.textContent = file.name;
                container.classList.remove('hidden');
                dropzone.classList.add('hidden');
            }
            
            reader.readAsDataURL(file);
        }
    }

    function removePosterPreview() {
        const input = document.getElementById('poster');
        const preview = document.getElementById('poster-preview');
        const container = document.getElementById('preview-container');
        const dropzone = document.getElementById('dropzone');
        
        input.value = '';
        preview.src = '#';
        container.classList.add('hidden');
        dropzone.classList.remove('hidden');
    }
</script>
@endsection