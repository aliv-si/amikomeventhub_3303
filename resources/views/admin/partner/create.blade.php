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

                {{-- Logo Partner --}}
                <div>
                    <span class="block text-sm font-bold text-slate-700 mb-2">Logo Partner</span>
                    <label for="logo" class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-[1.5rem] hover:border-indigo-400 transition-colors cursor-pointer relative" id="dropzone">
                        <input id="logo" name="logo" type="file" class="sr-only" accept="image/*" onchange="previewImage(event)">
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
                    <div id="preview-container" class="mt-4 hidden flex justify-center">
                        <div class="relative inline-block">
                            <img id="logo-preview" src="#" alt="Pratinjau Logo" class="h-28 w-auto object-contain rounded-xl border p-2 bg-slate-50">
                            <button type="button" onclick="removePreview()" class="absolute -top-2 -right-2 bg-rose-500 text-white rounded-full p-1.5 hover:bg-rose-600 transition shadow-lg">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Tombol Submit --}}
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="flex items-center gap-2 px-8 py-3.5 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
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
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                preview.src = e.target.result;
                container.classList.remove('hidden');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function removePreview() {
        const input = document.getElementById('logo');
        const preview = document.getElementById('logo-preview');
        const container = document.getElementById('preview-container');
        
        input.value = '';
        preview.src = '#';
        container.classList.add('hidden');
    }
</script>
@endsection