@extends('app')

@section('content')
<div class="min-h-screen bg-[#F0F2F5] pt-16 pb-24 px-6 lg:pl-36 lg:pr-12 font-['Inter'] relative z-10 transition-colors duration-300">
    <div class="max-w-7xl mx-auto">
        <!-- Header Section -->
        <div class="mb-10 lg:mb-14">
            <h1 class="text-3xl lg:text-4xl font-semibold text-[#1C1C1C] tracking-tight mb-2">Katalog Event</h1>
            <p class="text-[#8E8E8E] lg:text-[1.05rem] max-w-xl">Telusuri berbagai event terbaru yang paling sesuai dengan minat kamu. Semua event pilihan ada di sini.</p>
        </div>

        <!-- Grid Container -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
            
            <!-- Event Card 1 -->
            <div class="bg-white dark:bg-[#1C1C1C] rounded-[1.5rem] overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-black/5 dark:border-white/5 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_40px_rgba(171,246,45,0.15)] group flex flex-col">
                <div class="aspect-[4/3] bg-[#E5E5E5] dark:bg-[#303030] overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800&q=80" alt="Tech Conference" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 right-4 bg-[#ABF62D] text-[#1C1C1C] text-[0.7rem] font-bold px-3 py-1.5 rounded-full shadow-lg">
                        SEMINAR
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-[#ABF62D] text-xs font-semibold tracking-wider mb-2 uppercase">12 Nov 2026</div>
                    <h3 class="text-[1.1rem] font-semibold text-[#1C1C1C] dark:text-[#EDEDEC] mb-2 leading-snug line-clamp-2">Tech Startup Conference 2026</h3>
                    <p class="text-[0.9rem] text-[#8E8E8E] mb-6 line-clamp-2">Bergabunglah dalam konferensi teknologi terkemuka dengan ratusan startup dan investor teratas.</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-[0.95rem] font-bold text-[#1C1C1C] dark:text-[#EDEDEC]">Rp 150.000</span>
                        <a href="#" class="inline-flex items-center justify-center p-2 rounded-full bg-[#f0f0f0] dark:bg-[#303030] text-[#1C1C1C] dark:text-white hover:bg-[#ABF62D] dark:hover:bg-[#ABF62D] hover:text-[#1C1C1C] dark:hover:text-[#1C1C1C] transition-colors focus:outline-none">
                            <span class="material-symbols-outlined text-[1.2rem]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Event Card 2 -->
            <div class="bg-white dark:bg-[#1C1C1C] rounded-[1.5rem] overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-black/5 dark:border-white/5 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_40px_rgba(171,246,45,0.15)] group flex flex-col">
                <div class="aspect-[4/3] bg-[#E5E5E5] dark:bg-[#303030] overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&q=80" alt="UI/UX Workshop" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 right-4 bg-white dark:bg-[#303030] text-[#1C1C1C] dark:text-white text-[0.7rem] font-bold px-3 py-1.5 rounded-full shadow-lg">
                        WORKSHOP
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-[#ABF62D] text-xs font-semibold tracking-wider mb-2 uppercase">20 Nov 2026</div>
                    <h3 class="text-[1.1rem] font-semibold text-[#1C1C1C] dark:text-[#EDEDEC] mb-2 leading-snug line-clamp-2">Mastering Advanced UI/UX Design</h3>
                    <p class="text-[0.9rem] text-[#8E8E8E] mb-6 line-clamp-2">Praktik langsung mendesain antarmuka aplikasi dengan para pakar industri.</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-[0.95rem] font-bold text-[#1C1C1C] dark:text-[#EDEDEC]">Rp 250.000</span>
                        <a href="#" class="inline-flex items-center justify-center p-2 rounded-full bg-[#f0f0f0] dark:bg-[#303030] text-[#1C1C1C] dark:text-white hover:bg-[#ABF62D] dark:hover:bg-[#ABF62D] hover:text-[#1C1C1C] dark:hover:text-[#1C1C1C] transition-colors focus:outline-none">
                            <span class="material-symbols-outlined text-[1.2rem]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Event Card 3 -->
            <div class="bg-white dark:bg-[#1C1C1C] rounded-[1.5rem] overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-black/5 dark:border-white/5 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_40px_rgba(171,246,45,0.15)] group flex flex-col">
                <div class="aspect-[4/3] bg-[#E5E5E5] dark:bg-[#303030] overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1515169067868-5387ec356754?w=800&q=80" alt="Networking Night" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 right-4 bg-black text-[#ABF62D] border border-[#ABF62D]/30 text-[0.7rem] font-bold px-3 py-1.5 rounded-full shadow-lg">
                        NETWORKING
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-[#ABF62D] text-xs font-semibold tracking-wider mb-2 uppercase">01 Des 2026</div>
                    <h3 class="text-[1.1rem] font-semibold text-[#1C1C1C] dark:text-[#EDEDEC] mb-2 leading-snug line-clamp-2">Business Networking Night Gala</h3>
                    <p class="text-[0.9rem] text-[#8E8E8E] mb-6 line-clamp-2">Bangun koneksi bersama pimpinan perusahaan, profesional, dan pemangku kepentingan.</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-[0.95rem] font-bold text-[#ABF62D]">Gratis</span>
                        <a href="#" class="inline-flex items-center justify-center p-2 rounded-full bg-[#f0f0f0] dark:bg-[#303030] text-[#1C1C1C] dark:text-white hover:bg-[#ABF62D] dark:hover:bg-[#ABF62D] hover:text-[#1C1C1C] dark:hover:text-[#1C1C1C] transition-colors focus:outline-none">
                            <span class="material-symbols-outlined text-[1.2rem]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Event Card 4 -->
            <div class="bg-white dark:bg-[#1C1C1C] rounded-[1.5rem] overflow-hidden shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-black/5 dark:border-white/5 transition-all duration-300 hover:-translate-y-1.5 hover:shadow-[0_20px_40px_rgba(171,246,45,0.15)] group flex flex-col">
                <div class="aspect-[4/3] bg-[#E5E5E5] dark:bg-[#303030] overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800&q=80" alt="Code Hackathon" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 right-4 bg-[#ABF62D] text-[#1C1C1C] text-[0.7rem] font-bold px-3 py-1.5 rounded-full shadow-lg">
                        LOMBA
                    </div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <div class="text-[#ABF62D] text-xs font-semibold tracking-wider mb-2 uppercase">15 Des 2026</div>
                    <h3 class="text-[1.1rem] font-semibold text-[#1C1C1C] dark:text-[#EDEDEC] mb-2 leading-snug line-clamp-2">Creative Code Hackathon 48H</h3>
                    <p class="text-[0.9rem] text-[#8E8E8E] mb-6 line-clamp-2">Selesaikan tantangan koding selama 48 jam dan menangkan hadiah jutaan rupiah.</p>
                    <div class="flex items-center justify-between mt-auto">
                        <span class="text-[0.95rem] font-bold text-[#1C1C1C] dark:text-[#EDEDEC]">Rp 50.000</span>
                        <a href="#" class="inline-flex items-center justify-center p-2 rounded-full bg-[#f0f0f0] dark:bg-[#303030] text-[#1C1C1C] dark:text-white hover:bg-[#ABF62D] dark:hover:bg-[#ABF62D] hover:text-[#1C1C1C] dark:hover:text-[#1C1C1C] transition-colors focus:outline-none">
                            <span class="material-symbols-outlined text-[1.2rem]">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection