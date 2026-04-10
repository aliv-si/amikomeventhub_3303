@extends('app')

@section('content')
<div class="min-h-screen bg-[#F0F2F5] pt-16 pb-24 px-6 lg:pl-36 lg:pr-12 font-['Inter'] relative z-10 transition-colors duration-300">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="mb-12 lg:mb-16 text-center lg:text-left">
            <h1 class="text-3xl lg:text-4xl font-semibold text-[#1C1C1C] tracking-tight mb-3">Bantuan & FAQ</h1>
            <p class="text-[#8E8E8E] lg:text-[1.05rem] max-w-2xl mx-auto lg:mx-0">Punya pertanyaan seputar Amikom Event Hub? Temukan jawaban untuk pertanyaan yang paling sering diajukan di bawah ini.</p>
        </div>

        <!-- FAQ Items Container -->
        <div class="flex flex-col gap-4">

            <!-- Item 1 -->
            <details class="group bg-white rounded-[1.5rem] p-6 lg:p-8 shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-black/5 marker:content-[''] dark:bg-[#1C1C1C] dark:border-white/5 transition-all cursor-pointer">
                <summary class="flex justify-between items-center font-semibold list-none text-[#1C1C1C] dark:text-[#EDEDEC] text-[1.15rem] outline-none">
                    <div class="flex items-center gap-3 pr-4">
                        <span class="w-8 h-8 rounded-full bg-[#ABF62D] text-[#1C1C1C] flex items-center justify-center font-bold text-sm shrink-0">1</span>
                        Apa itu Amikom Event Hub?
                    </div>
                    <span class="transition-transform duration-300 group-open:rotate-180 bg-[#f0f0f0] dark:bg-[#303030] text-[#1C1C1C] dark:text-[#EDEDEC] rounded-full w-8 h-8 flex items-center justify-center shrink-0">
                        <svg fill="none" height="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="20">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <div class="mt-4 pl-11 transition-all overflow-hidden duration-300">
                    <p class="text-[#706f6c] dark:text-[#8E8E8E] text-[0.95rem] leading-relaxed">
                        Amikom Event Hub adalah platform digital terpadu yang dirancang khusus untuk mempermudah mahasiswa dan seluruh civitas akademika Universitas Amikom Yogyakarta dalam mencari, mendaftar, serta mengelola berbagai macam event kampus seperti seminar, workshop, lomba, dan networking.
                    </p>
                </div>
            </details>

            <!-- Item 2 -->
            <details class="group bg-white rounded-[1.5rem] p-6 lg:p-8 shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-black/5 marker:content-[''] dark:bg-[#1C1C1C] dark:border-white/5 transition-all cursor-pointer">
                <summary class="flex justify-between items-center font-semibold list-none text-[#1C1C1C] dark:text-[#EDEDEC] text-[1.15rem] outline-none">
                    <div class="flex items-center gap-3 pr-4">
                        <span class="w-8 h-8 rounded-full bg-[#ABF62D] text-[#1C1C1C] flex items-center justify-center font-bold text-sm shrink-0">2</span>
                        Bagaimana cara mendaftar ke sebuah event?
                    </div>
                    <span class="transition-transform duration-300 group-open:rotate-180 bg-[#f0f0f0] dark:bg-[#303030] text-[#1C1C1C] dark:text-[#EDEDEC] rounded-full w-8 h-8 flex items-center justify-center shrink-0">
                        <svg fill="none" height="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="20">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <div class="mt-4 pl-11 transition-all overflow-hidden duration-300">
                    <p class="text-[#706f6c] dark:text-[#8E8E8E] text-[0.95rem] leading-relaxed">
                        Sangat mudah! Pilih event yang kamu minati dari halaman <a href="{{ url('/katalog') }}" class="text-[#ABF62D] hover:underline font-medium">Katalog</a>, lalu klik tombol panah untuk melihat detail event. Jika kuota pendaftaran masih tersedia, silahkan klik tombol "Daftar Event" dan lengkapi formulir pendaftaran yang divalidasi dengan NIM kamu.
                    </p>
                </div>
            </details>

            <!-- Item 3 -->
            <details class="group bg-white rounded-[1.5rem] p-6 lg:p-8 shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-black/5 marker:content-[''] dark:bg-[#1C1C1C] dark:border-white/5 transition-all cursor-pointer">
                <summary class="flex justify-between items-center font-semibold list-none text-[#1C1C1C] dark:text-[#EDEDEC] text-[1.15rem] outline-none">
                    <div class="flex items-center gap-3 pr-4">
                        <span class="w-8 h-8 rounded-full bg-[#ABF62D] text-[#1C1C1C] flex items-center justify-center font-bold text-sm shrink-0">3</span>
                        Apakah semua event di platform ini gratis?
                    </div>
                    <span class="transition-transform duration-300 group-open:rotate-180 bg-[#f0f0f0] dark:bg-[#303030] text-[#1C1C1C] dark:text-[#EDEDEC] rounded-full w-8 h-8 flex items-center justify-center shrink-0">
                        <svg fill="none" height="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="20">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <div class="mt-4 pl-11 transition-all overflow-hidden duration-300">
                    <p class="text-[#706f6c] dark:text-[#8E8E8E] text-[0.95rem] leading-relaxed">
                        Tidak semua. Platform kami menyediakan kombinasi antara event yang 100% gratis maupun event berbayar (seperti workshop ber-SKPI atau seminar khusus). Harga tiket atau status "Gratis" selalu kami tampilkan secara jelas di beranda katalog dan pada komponen detail event.
                    </p>
                </div>
            </details>

            <!-- Item 4 -->
            <details class="group bg-white rounded-[1.5rem] p-6 lg:p-8 shadow-[0_10px_30px_rgba(0,0,0,0.03)] border border-black/5 marker:content-[''] dark:bg-[#1C1C1C] dark:border-white/5 transition-all cursor-pointer">
                <summary class="flex justify-between items-center font-semibold list-none text-[#1C1C1C] dark:text-[#EDEDEC] text-[1.15rem] outline-none">
                    <div class="flex items-center gap-3 pr-4">
                        <span class="w-8 h-8 rounded-full bg-[#ABF62D] text-[#1C1C1C] flex items-center justify-center font-bold text-sm shrink-0">4</span>
                        Siapa saja yang dapat menyelenggarakan event?
                    </div>
                    <span class="transition-transform duration-300 group-open:rotate-180 bg-[#f0f0f0] dark:bg-[#303030] text-[#1C1C1C] dark:text-[#EDEDEC] rounded-full w-8 h-8 flex items-center justify-center shrink-0">
                        <svg fill="none" height="20" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="20">
                            <path d="M6 9l6 6 6-6"></path>
                        </svg>
                    </span>
                </summary>
                <div class="mt-4 pl-11 transition-all overflow-hidden duration-300">
                    <p class="text-[#706f6c] dark:text-[#8E8E8E] text-[0.95rem] leading-relaxed">
                        Seluruh Organisasi Mahasiswa (Orma), kelompok studi, himpunan mahasiswa jurusan (HMJ), unit kegiatan kemahasiswaan (UKM), hingga dosen dan instansi resmi di lingkungan Universitas Amikom Yogyakarta dapat mengajukan dan mempublikasikan acaranya melalui dashboard admin/organizer Event Hub.
                    </p>
                </div>
            </details>

        </div>

        <!-- Contact Support -->
        <div class="mt-12 bg-[#1C1C1C] rounded-[2rem] p-10 flex flex-col sm:flex-row items-center justify-between gap-8 shadow-2xl relative overflow-hidden">
            <div class="absolute -right-10 -top-20 w-48 h-48 bg-[#ABF62D] opacity-20 blur-3xl rounded-full pointer-events-none"></div>

            <div class="relative z-10 text-center sm:text-left flex-1">
                <h3 class="text-[1.3rem] font-semibold text-white mb-2">Masih butuh bantuan lain?</h3>
                <p class="text-[#8E8E8E] text-[0.95rem] max-w-lg mx-auto sm:mx-0">Jika pertanyaan kamu tidak terjawab di atas, jangan ragu untuk menghubungi tim support kemahasiswaan kami.</p>
            </div>

            <ul class="flex flex-col mb-4 lg:mb-8 mt-8">
                <li>
                    <a href="{{ url('/kontak') }}" class="inline-flex items-center gap-2.5 dark:bg-[#ABF62D] dark:border-[#ABF62D] dark:text-[#1C1C1A] dark:hover:bg-[#9BE32A] dark:hover:border-[#9BE32A] hover:bg-[#303030] hover:border-black px-6 py-3 bg-[#1C1C1C] rounded-[1rem] border border-black text-white text-[0.95rem] font-medium leading-normal transition-colors focus:outline-none">
                        Hubungi Kami
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</div>
@endsection