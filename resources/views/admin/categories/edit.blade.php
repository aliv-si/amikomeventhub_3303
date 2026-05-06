@extends('layout.admin')

@section('content')
<main class="flex-1 p-10 overflow-y-auto">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Edit Kategori</h1>
            <p class="text-slate-500 font-medium">Edit kategori acara Anda di sini.</p>
        </div>
        <a href="{{ route('admin.categories') }}"
            class="flex items-center gap-2 px-5 py-2.5 text-slate-600 rounded-xl font-bold hover:text-indigo-600 active:scale-95 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </header>

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-8">
                <div class="mb-6">
                    <label for="name" class="block text-slate-500 font-medium mb-2">Nama Kategori</label>
                    <input type="text" name="name" id="name" value="{{ $category->name }}"
                        class="w-full px-5 py-3 rounded-xl border border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <div class="mb-6">
                    <label for="slug" class="block text-slate-500 font-medium mb-2">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ $category->slug }}"
                        class="w-full px-5 py-3 rounded-xl border border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 active:scale-95 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection