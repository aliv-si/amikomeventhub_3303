@extends('app')

@section('content')
<div class="min-h-screen bg-[#F0F2F5] flex items-center justify-center p-4 font-['Inter'] relative z-10 lg:pl-32">

    <!-- Outer wrapper (Green Card) -->
    <div class="w-full max-w-[420px] bg-[#ABF62D] rounded-[2.5rem] flex flex-col shadow-[0_20px_40px_rgba(0,0,0,0.08)] transition-all">

        <!-- Inner Dark Card -->
        <div class="bg-[#1C1C1C] w-full rounded-[2.5rem] p-8 pb-10 flex flex-col shadow-xl z-10">

            <div class="mb-8">
                <h2 class="text-white text-[1.6rem] font-semibold tracking-tight mb-2">Hubungi Kami</h2>
                <p class="text-[#8E8E8E] text-[0.95rem]">Jangan sungkan untuk menghubungi layanan dukungan kami 24/7.</p>
            </div>

            <!-- Contact Info -->
            <ul class="flex flex-col gap-6">

                <!-- Email -->
                <li class="flex items-start gap-4">
                    <span class="w-11 h-11 rounded-full bg-[#303030] text-[#ABF62D] flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[1.2rem]">mail</span>
                    </span>
                    <div class="flex flex-col justify-center">
                        <h4 class="text-[0.85rem] font-medium text-[#8E8E8E] mb-0.5">Alamat Email</h4>
                        <a href="mailto:support@amikomeventhub.com" class="text-white text-[0.95rem] hover:text-[#ABF62D] transition-colors focus:outline-none">support@amikomeventhub.com</a>
                    </div>
                </li>

                <!-- Telephone -->
                <li class="flex items-start gap-4">
                    <span class="w-11 h-11 rounded-full bg-[#303030] text-[#ABF62D] flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[1.2rem]">call</span>
                    </span>
                    <div class="flex flex-col justify-center">
                        <h4 class="text-[0.85rem] font-medium text-[#8E8E8E] mb-0.5">Telepon</h4>
                        <p class="text-white text-[0.95rem]">
                            (0274) 884201 ext. 120
                        </p>
                    </div>
                </li>

                <!-- Address -->
                <li class="flex items-start gap-4">
                    <span class="w-11 h-11 rounded-full bg-[#303030] text-[#ABF62D] flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-[1.2rem]">location_on</span>
                    </span>
                    <div class="flex flex-col justify-center">
                        <h4 class="text-[0.85rem] font-medium text-[#8E8E8E] mb-0.5">Alamat Kampus</h4>
                        <p class="text-white text-[0.95rem] leading-snug">
                            Universitas Amikom<br>
                            Jl. Ring Road Utara,<br>Sleman, DIY 55281
                        </p>
                    </div>
                </li>

            </ul>

        </div>

        <!-- Bottom Bar -->
        <div class="pt-4 pb-4 flex items-center justify-center gap-2 text-[#1C1C1C]">
            <span class="material-symbols-outlined text-[1.2rem]">support_agent</span>
            <span class="font-semibold text-[0.95rem] tracking-tight">Support Siap Membantu!</span>
        </div>

    </div>
</div>
@endsection