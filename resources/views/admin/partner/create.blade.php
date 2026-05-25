@extends('layout.admin')

@section('content')
<main class="flex-1 p-10 overflow-y-auto">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Tambah Partner</h1>
            <p class="text-slate-500 font-medium">Buat partner baru yang mendukung event Anda.</p>
        </div>
        <a href="{{ route('admin.partner') }}"
            class="flex items-center gap-2 px-5 py-2.5 text-slate-600 rounded-xl font-bold hover:text-indigo-600 active:scale-95 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </header>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
        <div class="px-10 py-8">
            {{-- Tampilkan error validasi jika ada --}}
            @if ($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 rounded-xl">
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

            <form action="{{ route('admin.partner.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                {{-- Nama Partner --}}
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Partner</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        placeholder="ex. Google, PT. Harapan Bangsa, dsb..."
                        class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-800 font-medium placeholder-slate-400 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 outline-none transition-all"
                        required autofocus>
                </div>

                {{-- expired at --}}
                <div>
                    <label for="expired_at" class="block text-sm font-bold text-slate-700 mb-2">Expired At</label>
                    <input type="date" name="expired_at" id="expired_at" value="{{ \Carbon\Carbon::now()->addMonths(6)->format('Y-m-d') }}"
                        class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-800 font-medium outline-none">
                </div>

                {{-- Logo Partner --}}
                <div>
                    <span class="block text-sm font-bold text-slate-700 mb-2">Logo Partner</span>
                    <input id="logo" name="logo" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)" required>
                    
                    <!-- Dropzone -->
                    <label id="dropzone" for="logo" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-[1.5rem] hover:border-indigo-400 transition-colors cursor-pointer relative">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-slate-600 justify-center">
                                <span class="font-bold text-indigo-600 hover:text-indigo-500">Pilih file logo</span>
                                <p class="pl-1">atau seret dan lepas</p>
                            </div>
                            <p class="text-xs text-slate-400">PNG, JPG, JPEG up to 2MB</p>
                        </div>
                    </label>
                    
                    <!-- Image preview container -->
                    <div id="preview-container" class="mt-1 hidden">
                        <div class="flex items-center gap-6 p-4 border border-slate-200 rounded-[1.5rem] bg-slate-50/50">
                            <div class="relative inline-block shrink-0">
                                <img id="logo-preview" src="#" alt="Pratinjau Logo" class="w-24 h-24 object-cover rounded-xl shadow-md border-2 border-white">
                                <button type="button" onclick="removePreview()" class="absolute -top-2 -right-2 bg-rose-500 text-white rounded-full p-1.5 hover:bg-rose-600 transition shadow-lg z-10" title="Hapus Gambar">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="space-y-2">
                                <p class="text-sm font-bold text-slate-700 truncate max-w-xs" id="file-name-text">Nama File</p>
                                <button type="button" onclick="document.getElementById('logo').click()" class="flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-600 rounded-xl text-xs font-bold hover:bg-indigo-100 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                    </svg>
                                    Ganti Gambar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="flex justify-end gap-4 mt-10 pt-6 border-t border-slate-100">
                    <a href="{{ route('admin.partner') }}" class="px-6 py-3 font-bold text-slate-400 hover:text-slate-600 transition duration-300">Batal</a>
                    <button type="submit" class="px-10 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transform active:scale-95 transition duration-300">
                        Simpan Partner
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('logo-preview');
        const container = document.getElementById('preview-container');
        const dropzone = document.getElementById('dropzone');
        const fileNameText = document.getElementById('file-name-text');
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const fileSizeInMB = file.size / (1024 * 1024);
            
            // Verifikasi ukuran file (maksimal 2MB)
            if (fileSizeInMB > 2) {
                alert('Ukuran file logo tidak boleh lebih dari 2MB!');
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

    function removePreview() {
        const input = document.getElementById('logo');
        const preview = document.getElementById('logo-preview');
        const container = document.getElementById('preview-container');
        const dropzone = document.getElementById('dropzone');
        const fileNameText = document.getElementById('file-name-text');
        
        input.value = '';
        preview.src = '#';
        fileNameText.textContent = 'Nama File';
        container.classList.add('hidden');
        dropzone.classList.remove('hidden');
    }
</script>
@endsection