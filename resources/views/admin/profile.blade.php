@extends('layout.admin')

@section('content')
<main class="flex-1 p-10 overflow-y-auto">
    <header class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black">Pengaturan Profil</h1>
            <p class="text-slate-500 font-medium">Atur nama dan foto profil akun Anda.</p>
        </div>
    </header>

    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-600 p-4 rounded-xl mb-6 font-bold text-sm">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl mb-6 font-bold text-sm">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm max-w-2xl">
        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-8">
                <div class="mb-8 flex items-center gap-6">
                    <div class="w-24 h-24 rounded-2xl bg-indigo-100 text-indigo-600 flex flex-col items-center justify-center font-bold text-3xl overflow-hidden shrink-0">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        @else
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        @endif
                    </div>
                    <div class="flex-1">
                        <label for="avatar" class="block text-slate-500 font-medium mb-2">Unggah Foto Profil Baru</label>
                        <input type="file" name="avatar" id="avatar" accept="image/*"
                            class="w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition">
                        <p class="text-xs text-slate-400 mt-2">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                    </div>
                </div>

                <div class="mb-6">
                    <label for="name" class="block text-slate-500 font-medium mb-2">Nama Lengkap / Organisasi</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                        class="w-full px-5 py-3 rounded-xl border border-slate-200 border bg-white focus:ring-2 focus:ring-indigo-500 outline-none transition">
                </div>

                <div class="mb-6">
                    <label class="block text-slate-500 font-medium mb-2">Email</label>
                    <input type="email" value="{{ $user->email }}" disabled
                        class="w-full px-5 py-3 rounded-xl border border-slate-200 border bg-slate-50 text-slate-500 cursor-not-allowed outline-none">
                    <p class="text-xs text-slate-400 mt-2">Email tidak dapat diubah.</p>
                </div>
                
                <div class="flex justify-end mt-10 pt-6 border-t border-slate-100">
                    <button type="submit" class="px-10 py-3 bg-indigo-600 text-white rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transform active:scale-95 transition duration-300">
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>
@endsection
