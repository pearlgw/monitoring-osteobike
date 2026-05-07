<aside id="sidebar" class="w-[220px] bg-white border-r border-slate-100 flex-col hidden md:flex flex-shrink-0">

    <nav class="flex-1 p-3 space-y-0.5">

        <p class="text-[10px] font-medium text-slate-400 uppercase tracking-widest px-2 pt-2 pb-1.5">Menu Utama</p>

        @php
            $menus = [
                ['route' => 'dashboard', 'label' => 'Dashboard', 'badge' => null, 'badge_color' => ''],
                ['route' => 'pasien.index', 'label' => 'Data Pasien', 'badge' => '', 'badge_color' => ''],
                ['route' => 'terapi.index', 'label' => 'Data Terapi', 'badge' => '', 'badge_color' => 'teal'],
                ['route' => 'pengingat-terapi.index', 'label' => 'Pengingat', 'badge' => '', 'badge_color' => 'amber'],
                ['route' => 'laporan-admin', 'label' => 'Laporan', 'badge' => null, 'badge_color' => ''],
            ];
        @endphp

        @foreach ($menus as $menu)
            @php $active = request()->routeIs($menu['route']); @endphp
            <a href="{{ $menu['route'] === '#' ? '#' : route($menu['route']) }}"
                class="relative flex items-center gap-2.5 px-2.5 py-2 rounded-[9px] transition
            {{ $active
                ? 'bg-[rgba(14,165,164,0.1)] border border-[rgba(14,165,164,0.2)]'
                : 'border border-transparent hover:bg-slate-50 hover:border-slate-100' }}">

                @if ($active)
                    <span class="absolute left-0 top-1/2 -translate-y-1/2 w-[3px] h-4 bg-[#0EA5A4] rounded-r-sm"></span>
                @endif

                @if ($menu['label'] === 'Dashboard')
                    <svg class="w-4 h-4 {{ $active ? 'text-[#0EA5A4]' : 'text-slate-400' }}" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                    </svg>
                @elseif ($menu['label'] === 'Data Pasien')
                    <svg class="w-4 h-4 {{ $active ? 'text-[#0EA5A4]' : 'text-slate-400' }}" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">

                        <!-- user icon -->
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                @elseif ($menu['label'] === 'Data Terapi')
                    <svg class="w-4 h-4 {{ $active ? 'text-[#0EA5A4]' : 'text-slate-400' }}" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <polyline points="22,12 18,12 15,21 9,3 6,12 2,12" />
                    </svg>
                @elseif ($menu['label'] === 'Pengingat')
                    <svg class="w-4 h-4 {{ $active ? 'text-[#0EA5A4]' : 'text-slate-400' }}" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                        <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                    </svg>
                @elseif ($menu['label'] === 'Laporan')
                    <svg class="w-4 h-4 {{ $active ? 'text-[#0EA5A4]' : 'text-slate-400' }}" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <path d="M8 17V13M12 17V9M16 17V13" />
                    </svg>
                @endif

                <span class="text-[13px] {{ $active ? 'text-slate-900 font-medium' : 'text-slate-500' }}">
                    {{ $menu['label'] }}
                </span>

                @if ($menu['badge'])
                    @if ($menu['badge_color'] === 'teal')
                        <span
                            class="ml-auto text-[10px] font-medium px-1.5 py-0.5 rounded-full bg-[rgba(14,165,164,0.1)] text-[#0EA5A4]">{{ $menu['badge'] }}</span>
                    @elseif ($menu['badge_color'] === 'amber')
                        <span
                            class="ml-auto text-[10px] font-medium px-1.5 py-0.5 rounded-full bg-amber-50 text-amber-700">{{ $menu['badge'] }}</span>
                    @endif
                @endif
            </a>
        @endforeach
    </nav>

    {{-- Profile footer --}}
    <div class="p-3 border-t border-slate-100">
        <div class="flex items-center gap-2.5 px-2.5 py-2 rounded-[9px] bg-slate-50 border border-slate-100">
            <div class="w-[30px] h-[30px] rounded-lg bg-[#0EA5A4] flex items-center justify-center flex-shrink-0">
                <span class="text-white font-bold text-[11px]" style="font-family:'Syne',sans-serif;">
                    {{ strtoupper(substr(auth()->user()->nama_lengkap, 0, 2)) }}
                </span>
            </div>
            <div class="flex flex-col min-w-0">
                <span class="text-[12px] font-medium text-slate-700 truncate">{{ auth()->user()->nama_lengkap }}</span>
                <span class="text-[10px] text-slate-400">{{ ucfirst(auth()->user()->role) }}</span>
            </div>
        </div>
    </div>

</aside>

<script>
    function toggleSidebar() {
        const sb = document.getElementById('sidebar');
        sb.classList.toggle('hidden');
        sb.classList.toggle('flex');
    }
</script>
