<!DOCTYPE html>

<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700;800&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
</head>

<body class="font-['Inter'] relative">
    
    @if(!request()->is('/'))
        <!-- Floating Sidebar Navigation -->
        <nav class="fixed left-6 top-1/2 -translate-y-1/2 z-50 flex flex-col gap-3 p-3 bg-[#1C1C1C]/80 backdrop-blur-xl border border-white/10 rounded-[2rem] shadow-2xl">
            
            <!-- Navbar Home Item -->
            <a href="{{ url('/') }}" class="group relative flex items-center justify-center p-3.5 rounded-full {{ request()->is('/') ? 'bg-[#ABF62D] text-black shadow-[0_0_15px_rgba(171,246,45,0.4)]' : 'text-gray-400 hover:bg-white/10 hover:text-white' }} transition-all duration-300">
                <span class="material-symbols-outlined text-[1.4rem]" style="font-variation-settings: 'FILL' {{ request()->is('/') ? '1' : '0' }}">home</span>
                <!-- Tooltip -->
                <span class="absolute left-full ml-4 px-3 py-1.5 bg-[#1C1C1C] border border-white/10 text-white text-[0.8rem] font-medium rounded-[0.5rem] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-x-2 group-hover:translate-x-0 whitespace-nowrap shadow-xl">
                    Home
                </span>
            </a>

            <!-- Navbar Profil Item -->
            <a href="{{ url('/profil') }}" class="group relative flex items-center justify-center p-3.5 rounded-full {{ request()->is('profil') ? 'bg-[#ABF62D] text-black shadow-[0_0_15px_rgba(171,246,45,0.4)]' : 'text-gray-400 hover:bg-white/10 hover:text-white' }} transition-all duration-300">
                <span class="material-symbols-outlined text-[1.4rem]" style="font-variation-settings: 'FILL' {{ request()->is('profil') ? '1' : '0' }}">person</span>
                <!-- Tooltip -->
                <span class="absolute left-full ml-4 px-3 py-1.5 bg-[#1C1C1C] border border-white/10 text-white text-[0.8rem] font-medium rounded-[0.5rem] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-x-2 group-hover:translate-x-0 whitespace-nowrap shadow-xl">
                    Profil Mahasiswa
                </span>
            </a>

            <!-- Navbar Katalog Item -->
            <a href="{{ url('/katalog') }}" class="group relative flex items-center justify-center p-3.5 rounded-full {{ request()->is('katalog') ? 'bg-[#ABF62D] text-black shadow-[0_0_15px_rgba(171,246,45,0.4)]' : 'text-gray-400 hover:bg-white/10 hover:text-white' }} transition-all duration-300">
                <span class="material-symbols-outlined text-[1.4rem]" style="font-variation-settings: 'FILL' {{ request()->is('katalog') ? '1' : '0' }}">storefront</span>
                <!-- Tooltip -->
                <span class="absolute left-full ml-4 px-3 py-1.5 bg-[#1C1C1C] border border-white/10 text-white text-[0.8rem] font-medium rounded-[0.5rem] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-x-2 group-hover:translate-x-0 whitespace-nowrap shadow-xl">
                    Katalog Event
                </span>
            </a>

            <!-- Navbar Bantuan Item -->
            <a href="{{ url('/bantuan') }}" class="group relative flex items-center justify-center p-3.5 rounded-full {{ request()->is('bantuan') ? 'bg-[#ABF62D] text-black shadow-[0_0_15px_rgba(171,246,45,0.4)]' : 'text-gray-400 hover:bg-white/10 hover:text-white' }} transition-all duration-300">
                <span class="material-symbols-outlined text-[1.4rem]" style="font-variation-settings: 'FILL' {{ request()->is('bantuan') ? '1' : '0' }}">help</span>
                <!-- Tooltip -->
                <span class="absolute left-full ml-4 px-3 py-1.5 bg-[#1C1C1C] border border-white/10 text-white text-[0.8rem] font-medium rounded-[0.5rem] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-x-2 group-hover:translate-x-0 whitespace-nowrap shadow-xl">
                    Bantuan & FAQ
                </span>
            </a>

            <!-- Navbar Kontak Item -->
            <a href="{{ url('/kontak') }}" class="group relative flex items-center justify-center p-3.5 rounded-full {{ request()->is('kontak') ? 'bg-[#ABF62D] text-black shadow-[0_0_15px_rgba(171,246,45,0.4)]' : 'text-gray-400 hover:bg-white/10 hover:text-white' }} transition-all duration-300">
                <span class="material-symbols-outlined text-[1.4rem]" style="font-variation-settings: 'FILL' {{ request()->is('kontak') ? '1' : '0' }}">mail</span>
                <!-- Tooltip -->
                <span class="absolute left-full ml-4 px-3 py-1.5 bg-[#1C1C1C] border border-white/10 text-white text-[0.8rem] font-medium rounded-[0.5rem] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-x-2 group-hover:translate-x-0 whitespace-nowrap shadow-xl">
                    Hubungi Kami
                </span>
            </a>

        </nav>
    @endif

    @yield('content')
</body>

</html>