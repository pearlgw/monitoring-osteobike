<footer class="relative overflow-hidden bg-[#0c1a2e] text-white">

    {{-- Background grid --}}
    <div class="absolute inset-0"
        style="background-image: linear-gradient(rgba(14,165,164,0.06) 1px,transparent 1px),linear-gradient(90deg,rgba(14,165,164,0.06) 1px,transparent 1px); background-size: 48px 48px;">
    </div>

    {{-- Orbs --}}
    <div class="absolute -top-40 -left-28 w-[500px] h-[500px] rounded-full pointer-events-none"
        style="background: radial-gradient(circle, rgba(14,165,164,0.18) 0%, transparent 65%);"></div>
    <div class="absolute -bottom-36 -right-20 w-[400px] h-[400px] rounded-full pointer-events-none"
        style="background: radial-gradient(circle, rgba(59,130,246,0.12) 0%, transparent 65%);"></div>
    <div class="absolute top-10 right-48 w-48 h-48 rounded-full pointer-events-none"
        style="background: radial-gradient(circle, rgba(245,158,11,0.14) 0%, transparent 65%);"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8 pt-12 pb-8">

        <div class="flex flex-col md:flex-row items-center justify-between gap-4">

            {{-- Left: Copyright --}}
            <p class="text-xs text-gray-600 order-2 md:order-1">
                &copy; {{ date('Y') }} <span class="text-gray-500">Osteobike</span>. All rights reserved. &dash;
                Built with <span class="text-[#F59E0B]">&#9679;</span> in Indonesia.
            </p>

            {{-- Center: Tech Badges --}}
            <div class="flex items-center gap-2 order-1 md:order-2">
                @foreach (['IoT', 'Real-time', 'Terenkripsi'] as $badge)
                    <span
                        class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-[10px] font-medium tracking-wide border border-white/[0.08] text-gray-500">
                        <span class="w-1 h-1 rounded-full bg-[#0EA5A4]"></span>
                        {{ $badge }}
                    </span>
                @endforeach
            </div>

            {{-- Right: Social --}}
            <div class="flex items-center gap-3 order-3">
                <div class="flex items-center gap-3 mb-5">
                    <div class="relative w-10 h-10 flex items-center justify-center">
                        <div class="absolute inset-0 rounded-xl bg-[#0EA5A4] opacity-20"></div>
                        <svg class="w-6 h-6 text-[#0EA5A4] relative z-10" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 3c4.97 0 9 4.03 9 9s-4.03 9-9 9-9-4.03-9-9 4.03-9 9-9zM8 12h8M12 8v8" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-white">
                        Osteo<span class="text-[#0EA5A4]">bike</span>
                    </span>
                </div>
            </div>

        </div>

    </div>
</footer>
