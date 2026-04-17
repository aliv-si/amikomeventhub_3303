@extends('app')

@section('content')
<div class="flex items-center justify-center w-full min-h-screen transition-opacity opacity-100 duration-750 starting:opacity-0 relative z-10 lg:p-8 p-4 bg-[#F0F2F5] dark:bg-[#0a0a0a]">
    <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row shadow-[0_20px_40px_rgba(0,0,0,0.06)] dark:shadow-[0_20px_40px_rgba(0,0,0,0.2)] rounded-[2rem] lg:rounded-[2.5rem] transition-all border border-black/5 dark:border-white/10 overflow-hidden bg-white dark:bg-[#1C1C1C]">
        <div class="text-[13px] leading-[20px] flex-1 p-8 pb-8 lg:p-16 lg:pb-12 dark:text-[#EDEDEC] relative z-20">
            <h1 class="mb-2 font-semibold text-2xl lg:text-3xl tracking-tight">Let's get started</h1>
            <p class="mb-4 text-[#706f6c] text-[0.95rem] dark:text-[#8E8E8E]">This page is part of Digital Business assignment, <br \>the student’s identity in the section below :</p>
            <ul class="flex flex-col mb-4 lg:mb-8 mt-8">
                <li>
                    <a href="{{ url('/profil') }}" class="inline-flex items-center gap-2.5 dark:bg-[#ABF62D] dark:border-[#ABF62D] dark:text-[#1C1C1A] dark:hover:bg-[#9BE32A] dark:hover:border-[#9BE32A] hover:bg-[#303030] hover:border-black px-6 py-3 bg-[#1C1C1C] rounded-[1rem] border border-black text-white text-[0.95rem] font-medium leading-normal transition-colors focus:outline-none">
                        Go to Main Web 
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="M12 5l7 7-7 7"></path></svg>
                    </a>
                </li>
            </ul>
        </div>
        <div class="bg-[#F6FCE8] dark:bg-[#1a2310] relative aspect-auto lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden flex items-center justify-center border-b lg:border-b-0 lg:border-l border-black/5 dark:border-[#303030]">
            <img src="{{ asset('img/thumbs.gif') }}" alt="Thumbs Bear" class="w-full h-full object-cover transition-all translate-y-0 opacity-100 mx-auto duration-750 starting:opacity-0 motion-safe:starting:translate-y-6 mix-blend-multiply dark:mix-blend-normal">    
        </div>
    </main>
</div>
@endsection