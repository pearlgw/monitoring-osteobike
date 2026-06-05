<nav class="h-[58px] bg-white border-b border-slate-100 flex items-center justify-between px-5 flex-shrink-0">

    {{-- Left --}}
    <div class="flex items-center gap-3">

        {{-- Hamburger (mobile) --}}
        <button onclick="toggleSidebar()"
            class="w-8 h-8 rounded-lg bg-slate-50 border border-slate-200 flex items-center justify-center md:hidden">
            <svg class="w-4 h-4 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round">
                <line x1="3" y1="6" x2="21" y2="6" />
                <line x1="3" y1="12" x2="21" y2="12" />
                <line x1="3" y1="18" x2="21" y2="18" />
            </svg>
        </button>

        {{-- Brand --}}
        <a href="/" class="flex items-center gap-2">
            {{-- <div class="w-[30px] h-[30px] bg-[#0EA5A4] rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
                    <path d="M5 16L5 8C5 6.9 5.9 6 7 6L17 6C18.1 6 19 6.9 19 8L19 16" stroke="white" stroke-width="2"
                        stroke-linecap="round" />
                    <circle cx="12" cy="17" r="2.5" stroke="white" stroke-width="2" />
                    <path d="M5 16C5 16 6.5 14 12 14C17.5 14 19 16 19 16" stroke="white" stroke-width="2"
                        stroke-linecap="round" />
                    <circle cx="7" cy="10" r="1" fill="white" />
                    <circle cx="12" cy="9" r="1" fill="white" />
                    <circle cx="17" cy="10" r="1" fill="white" />
                </svg>
            </div> --}}
            {{-- Logo 1 --}}
            <div class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center overflow-hidden">
                <img src="/images/new_logo.jpeg" alt="Logo 1" class="w-full h-full object-contain">
            </div>

            {{-- Logo 2 --}}
            <div class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center overflow-hidden">
                <img src="/images/undip.jpeg" alt="Logo 2" class="w-full h-full object-contain">
            </div>

            {{-- Logo 3 --}}
            <div class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center overflow-hidden">
                <img src="/images/udinus.png" alt="Logo 3" class="w-full h-full object-contain">
            </div>

            {{-- Logo 4 --}}
            <div class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center overflow-hidden">
                <img src="/images/logo_unggul.jpeg" alt="Logo 4" class="w-full h-full object-contain">
            </div>

            <span class="font-black text-base text-slate-900" style="font-family:'Syne',sans-serif;">
                Osteo<span class="text-[#0EA5A4]">bike</span>
            </span>
        </a>

        <div class="hidden md:block w-px h-5 bg-slate-200"></div>

        {{-- Breadcrumb --}}
        <span class="hidden md:block text-[13px] text-slate-400">
            <span class="text-slate-500 font-medium">Dashboard</span>
            · Overview
        </span>
    </div>

    {{-- Right --}}
    <div class="flex items-center gap-2">

        {{-- User Info --}}
        <div
            class="hidden md:flex items-center gap-2 px-2.5 py-1.5 rounded-[10px] border border-slate-200 cursor-pointer hover:bg-slate-50 transition">
            <div class="w-7 h-7 rounded-lg bg-[#0EA5A4] flex items-center justify-center flex-shrink-0">
                <span class="text-white font-bold text-[11px]" style="font-family:'Syne',sans-serif;">
                    {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 2)) }}
                </span>
            </div>
            <div class="flex flex-col">
                <span
                    class="text-[13px] font-medium text-slate-700 leading-tight">{{ auth()->user()->nama_lengkap }}</span>
                <span class="text-[10px] text-slate-400 leading-tight">{{ ucfirst(auth()->user()->role) }}</span>
            </div>
            <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round">
                <polyline points="6 9 12 15 18 9" />
            </svg>
        </div>

        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center gap-1.5 text-[12px] font-medium text-red-500 px-2.5 py-1.5 rounded-lg border border-red-100 hover:bg-red-50 transition">
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                Logout
            </button>
        </form>
    </div>
</nav>
