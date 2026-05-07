<section class="relative bg-[#0c1a2e] overflow-hidden min-h-[520px] flex items-center">

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

    <div class="max-w-6xl mx-auto px-8 py-16 grid grid-cols-2 gap-12 items-center relative z-10 w-full">

        {{-- Left: Copy --}}
        <div>
            <div
                class="inline-flex items-center gap-2 bg-[rgba(14,165,164,0.12)] border border-[rgba(14,165,164,0.3)] rounded-full px-3.5 py-1.5 mb-5">
                <span class="w-1.5 h-1.5 bg-[#0EA5A4] rounded-full animate-pulse"></span>
                <span class="text-[#0EA5A4] text-xs font-medium tracking-wide">Terapi Tulang Berbasis Teknologi</span>
            </div>

            <h1 class="font-black text-white tracking-tight mb-4"
                style="font-family: 'Syne', sans-serif; font-size: clamp(32px, 5vw, 52px); line-height: 1.08; letter-spacing: -0.03em;">
                OSTEOBIKE<br>
                <span
                    style="font-size: 0.65em; font-weight: 700; letter-spacing: -0.01em; color: #0EA5A4;">Osteoarthritis</span>
                <span
                    style="font-size: 0.65em; font-weight: 500; letter-spacing: -0.01em; color: rgba(255,255,255,0.85);">
                    Smart </span>
                <span style="font-size: 0.65em; font-weight: 700; letter-spacing: -0.01em; color: #F59E0B;">Therapy Bike
                    for Rehabilitation</span>
            </h1>
            <p class="text-white/60 text-base font-light leading-relaxed mb-7 max-w-[440px]">
                Solusi terapi berbasis sepeda statis untuk membantu mengurangi nyeri, meningkatkan kekuatan otot, dan
                memantau progres latihan pasien osteoartritis secara real-time.
            </p>

            <div class="flex gap-6 mb-8">
                <div class="flex flex-col">
                    <span class="text-white/40 text-[11px] uppercase tracking-wide mt-0.5">Prototipe Berbasis
                        Riset</span>
                </div>
                <div class="w-px bg-white/10"></div>
                <div class="flex flex-col">
                    <span class="text-white/40 text-[11px] uppercase tracking-wide mt-0.5">Monitoring Real-time</span>
                </div>
                <div class="w-px bg-white/10"></div>
                <div class="flex flex-col">
                    <span class="text-white/40 text-[11px] uppercase tracking-wide mt-0.5">Latihan Rendah Risiko</span>
                </div>
            </div>

            <div class="flex gap-3 items-center">
                <a href="{{ route('laporan') }}"
                    class="inline-flex items-center gap-2 bg-[#0EA5A4] text-white text-sm font-medium px-6 py-3 rounded-[10px] hover:bg-[#0c8f8e] hover:-translate-y-px transition-all">
                    Cetak Hasil
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>

        {{-- Right: Static Image --}}
        <div class="relative flex justify-center items-center">

            {{-- Floating pill top-left --}}
            <div
                class="absolute -top-3 -left-3 flex items-center gap-2 bg-[rgba(12,26,46,0.9)] border border-[rgba(14,165,164,0.3)] rounded-[10px] px-3 py-2 z-10">
                <div
                    class="w-7 h-7 bg-[rgba(14,165,164,0.18)] rounded-lg flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="#0EA5A4" stroke-width="2.2"
                        stroke-linecap="round">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-white font-bold text-[13px]" style="font-family: 'Syne', sans-serif;">Sesi
                        Aktif</span>
                    <span class="text-white/45 text-[10px]"></span>
                </div>
            </div>

            {{-- ✅ GANTI PATH DI SINI --}}
            <img src="{{ asset('images/alat.jpeg') }}" alt="Osteobike"
                class="w-full max-w-[360px] object-contain rounded-[20px]" />

            {{-- Floating pill bottom-right --}}
            <div
                class="absolute -bottom-3 -right-3 flex items-center gap-2 bg-[rgba(12,26,46,0.9)] border border-[rgba(14,165,164,0.3)] rounded-[10px] px-3 py-2 z-10">
                <div
                    class="w-7 h-7 bg-[rgba(245,158,11,0.18)] rounded-lg flex items-center justify-center flex-shrink-0">
                    {{-- <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2.2"
                        stroke-linecap="round">
                        <path
                            d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                    </svg> --}}
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2.2"
                        stroke-linecap="round">
                        <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-white font-bold text-[13px]" style="font-family: 'Syne', sans-serif;">Sesi
                        Pasif</span>
                    <span class="text-white/45 text-[10px]"></span>
                </div>
            </div>

        </div>

    </div>
</section>
