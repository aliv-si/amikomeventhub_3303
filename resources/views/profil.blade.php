@extends('app')

@section('content')
<div class="min-h-screen bg-[#F0F2F5] flex items-center justify-center p-4 font-['Inter']">
    
    <!-- Outer wrapper (Green Card) -->
    <div class="w-full max-w-[420px] bg-[#ABF62D] rounded-[2.5rem] flex flex-col shadow-[0_20px_40px_rgba(0,0,0,0.08)] transition-all">
        
        <!-- Inner Dark Card -->
        <div class="bg-[#1C1C1C] w-full rounded-[2.5rem] p-8 pb-10 flex flex-col shadow-xl z-10">
            
            <!-- Profile Info -->
            <div class="flex items-center gap-5 mb-8">
                <!-- Avatar -->
                <div class="w-[76px] h-[76px] rounded-full bg-[#E5E5E5] flex-shrink-0 overflow-hidden">
                    <img src="https://ui-avatars.com/api/?name=Alief+Fathin&background=E5E5E5&color=1C1C1C&size=200&font-size=0.35&bold=true" alt="Alief Fathin" class="w-full h-full object-cover">
                </div>
                
                <!-- Text -->
                <div class="flex flex-col justify-center">
                    <h2 class="text-white text-[1.4rem] font-medium tracking-tight mb-1.5 focus:outline-none">Alief Fathin Adi Kusuma</h2>
                    <div class="flex items-center gap-2 text-[#8E8E8E] text-[0.9rem] font-medium">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#ABF62D]"></span>
                        24.12.3303
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-3">
                <a href="mailto:aliv@students.amikom.ac.id" class="flex-1 bg-[#303030] hover:bg-[#3A3A3D] text-white py-4 px-4 rounded-[1.1rem] flex items-center justify-center gap-2.5 transition-colors focus:outline-none">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    <span class="text-[0.95rem] font-medium tracking-wide">Email Me</span>
                </a>
                
                <button onclick="navigator.clipboard.writeText('aliv@students.amikom.ac.id'); alert('Email disalin ke clipboard!')" class="flex-1 bg-[#303030] hover:bg-[#3A3A3D] text-white py-4 px-4 rounded-[1.1rem] flex items-center justify-center gap-2.5 transition-colors focus:outline-none">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg>
                    <span class="text-[0.95rem] font-medium tracking-wide">Copy Email</span>
                </button>
            </div>
            
        </div>

        <!-- Bottom Bar -->
        <div class="pt-4 pb-4 flex items-center justify-center gap-2 text-[#1C1C1C]">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
            <span class="font-semibold text-[0.95rem] tracking-tight">Currently High on Creativity</span>
        </div>

    </div>
</div>
@endsection