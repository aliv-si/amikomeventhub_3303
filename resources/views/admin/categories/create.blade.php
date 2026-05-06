@extends('layout.admin')

@section('content')
<main class="flex-1 p-10 overflow-y-auto">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Tambah Kategori</h1>
            <p class="text-slate-500 font-medium">Buat kategori baru untuk mengelompokkan event Anda.</p>
        </div>
        <a href="{{ route('admin.categories') }}"
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

            <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-6">
                @csrf

                {{-- Nama Kategori --}}
                <div>
                    <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Kategori</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        placeholder="ex. workshop, seminar, technology..."
                        class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-800 font-medium placeholder-slate-400 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 outline-none transition-all"
                        required autofocus>
                </div>

                {{-- Slug --}}
                <div>
                    <label for="slug" class="block text-sm font-bold text-slate-700 mb-2">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                        placeholder="slug akan terisi otomatis"
                        class="w-full px-5 py-3.5 rounded-xl border border-slate-200 bg-slate-50 text-slate-600 font-mono text-sm placeholder-slate-400 focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 outline-none transition-all"
                        readonly>
                    <p class="mt-2 text-xs text-slate-400">slug akan digunakan sebagai URL-friendly identifier.</p>
                </div>

                {{-- Tombol Submit --}}
                <div class="flex justify-end pt-4">
                    <button type="submit"
                        class="flex items-center gap-2 px-8 py-3.5 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 active:scale-95 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    // Auto-generate slug dari nama kategori
    const nameInput = document.getElementById('name');
    const slugInput = document.getElementById('slug');

    nameInput.addEventListener('input', function() {
        slugInput.value = this.value
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Hapus karakter spesial
            .replace(/\s+/g, '-') // Spasi jadi strip
            .replace(/-+/g, '-') // Hapus strip berlebih
            .replace(/^-|-$/g, ''); // Hapus strip di awal/akhir
    });
</script>
@endsection