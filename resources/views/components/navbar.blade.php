<nav class="relative bg-white border-b border-teal-100 overflow-hidden">
    {{-- Glow decorations --}}
    <div
        class="absolute -top-14 -left-10 w-56 h-36 bg-[radial-gradient(ellipse,rgba(14,165,164,0.12),transparent_70%)] pointer-events-none">
    </div>
    <div
        class="absolute -top-10 right-20 w-44 h-28 bg-[radial-gradient(ellipse,rgba(245,158,11,0.08),transparent_70%)] pointer-events-none">
    </div>

    <div class="max-w-6xl mx-auto px-6 h-[68px] flex items-center justify-between gap-6 relative">

        {{-- Brand --}}
        <a href="{{ url('/') }}" class="flex items-center gap-3 no-underline">

            {{-- Logo 1 --}}
            <div class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center overflow-hidden">
                <img src="/images/logo.jpeg" alt="Logo 1" class="w-full h-full object-contain">
            </div>

            {{-- Logo 2 --}}
            <div class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center overflow-hidden">
                <img src="/images/undip.jpeg" alt="Logo 2" class="w-full h-full object-contain">
            </div>

            {{-- Logo 3 --}}
            <div class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center overflow-hidden">
                <img src="/images/udinus.png" alt="Logo 3" class="w-full h-full object-contain">
            </div>

            {{-- Text --}}
            <div class="flex flex-col leading-none ml-1">
                <span class="font-black text-lg text-slate-900 tracking-tight" style="font-family: 'Syne', sans-serif;">
                    Osteo<span class="text-[#0EA5A4]">bike</span>
                </span>
                <span class="text-[10px] text-slate-400 uppercase tracking-widest mt-0.5">
                    Bone Health Monitor
                </span>
            </div>

        </a>

        {{-- Nav Links --}}
        <nav class="flex items-center gap-1">
            <a href="{{ url('/') }}"
                class="text-sm font-medium text-[#0EA5A4] px-3.5 py-1.5 rounded-lg relative hover:bg-teal-50 transition-all">
                Home
                <span
                    class="absolute bottom-1 left-1/2 -translate-x-1/2 w-[18px] h-0.5 bg-[#0EA5A4] rounded-full"></span>
            </a>
            <a href="#about"
                class="text-sm font-medium text-slate-500 px-3.5 py-1.5 rounded-lg hover:text-slate-900 hover:bg-teal-50/70 transition-all">About</a>
            <a href="#manfaat"
                class="text-sm font-medium text-slate-500 px-3.5 py-1.5 rounded-lg hover:text-slate-900 hover:bg-teal-50/70 transition-all">Manfaat</a>
        </nav>

        {{-- Right Side --}}
        <div class="flex items-center">
            <a href="{{ auth()->check() ? route('dashboard') : route('login') }}"
                class="inline-flex items-center gap-1.5 text-sm font-medium text-white
                bg-gradient-to-r from-[#0EA5A4] to-[#0bc9c8]
                px-5 py-2 rounded-[10px]
                shadow-[0_2px_8px_rgba(14,165,164,0.28)]
                hover:shadow-[0_4px_14px_rgba(14,165,164,0.4)]
                hover:-translate-y-px transition-all">

                {{ auth()->check() ? 'Dashboard' : 'Masuk' }}

                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14M12 5l7 7-7 7" />
                </svg>
            </a>
        </div>

    </div>
</nav>

{{-- Google Font Syne (taruh di layout head) --}}
