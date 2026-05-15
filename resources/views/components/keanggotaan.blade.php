<section class="relative py-20 px-6 overflow-hidden bg-white" id="about">

    {{-- Background blobs --}}
    <div class="absolute -top-16 -left-16 w-72 h-72 rounded-full opacity-10 blur-3xl pointer-events-none"
        style="background-color: #0EA5A4;"></div>
    <div class="absolute -bottom-12 -right-12 w-60 h-60 rounded-full opacity-10 blur-3xl pointer-events-none"
        style="background-color: #3B82F6;"></div>

    {{-- ===== ABOUT ===== --}}
    <div class="max-w-5xl mx-auto mb-20">

        <p class="text-center text-xs font-semibold tracking-[3px] uppercase mb-3" style="color: #0EA5A4;">Tentang Kami
        </p>

        <h2 class="text-center font-extrabold text-4xl md:text-5xl leading-tight mb-6 text-gray-900">
            Apa itu
            <span class="bg-gradient-to-r from-[#0EA5A4] to-[#3B82F6] bg-clip-text text-transparent">
                Osteobike?
            </span>
        </h2>

        {{-- Divider --}}
        <div class="flex items-center justify-center gap-3 mb-10">
            <div class="h-px w-16 bg-gray-200"></div>
            <div class="w-2 h-2 rounded-full" style="background-color: #0EA5A4;"></div>
            <div class="h-px w-16 bg-gray-200"></div>
        </div>

        {{-- About grid --}}
        <div class="grid md:grid-cols-2 gap-10 items-center">

            {{-- Teks --}}
            <div class="text-left space-y-4">
                <div class="text-gray-600 text-base leading-relaxed space-y-3 text-justify">
                    <p>
                        Osteoartritis (OA) adalah penyakit degeneratif sendi yang menyebabkan kerusakan tulang rawan,
                        kekakuan, serta nyeri, terutama pada lutut dan panggul. Kondisi ini dapat menurunkan kemampuan
                        gerak dan kualitas hidup penderitanya.
                    </p>

                    <p>
                        Untuk membantu proses rehabilitasi, dikembangkan <span
                            class="font-medium text-gray-700">Osteobike</span>,
                        yaitu prototipe sepeda statis yang memungkinkan latihan dalam posisi duduk sehingga lebih aman
                        dan mengurangi beban pada sendi.
                    </p>

                    <p>
                        Sistem ini juga dilengkapi dengan teknologi berbasis web untuk memantau progres latihan pasien
                        secara <span class="text-[#0EA5A4] font-medium">real-time</span>, sehingga terapi dapat
                        dilakukan
                        secara lebih terukur, aman, dan efektif.
                    </p>

                </div>

                {{-- Stats --}}
                {{-- <div class="grid grid-cols-3 gap-4 pt-4">
                    <div class="text-center p-4 rounded-2xl" style="background-color: rgba(14,165,164,0.07);">
                        <p class="font-extrabold text-2xl" style="color: #0EA5A4;">4</p>
                        <p class="text-xs text-gray-500 mt-1">Anggota Tim</p>
                    </div>
                    <div class="text-center p-4 rounded-2xl" style="background-color: rgba(59,130,246,0.07);">
                        <p class="font-extrabold text-2xl" style="color: #3B82F6;">Real-Time</p>
                        <p class="text-xs text-gray-500 mt-1">Monitoring</p>
                    </div>
                    <div class="text-center p-4 rounded-2xl" style="background-color: rgba(245,158,11,0.07);">
                        <p class="font-extrabold text-2xl" style="color: #F59E0B;">100%</p>
                        <p class="text-xs text-gray-500 mt-1">Aman & Terukur</p>
                    </div>
                </div> --}}
            </div>

            {{-- Ilustrasi / Gambar --}}
            <div class="relative">
                <div
                    class="rounded-2xl overflow-hidden border border-gray-100 shadow-lg aspect-video bg-gray-50 flex items-center justify-center">
                    {{-- Ganti src dengan gambar project / alat osteobike --}}
                    <img src="/images/about.jpeg" alt="Osteobike Device" class="w-full object-cover"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    {{-- Fallback jika gambar belum ada --}}
                    <div class="hidden flex-col items-center gap-2 text-gray-300 p-8">
                        <svg class="w-16 h-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="3" width="18" height="18" rx="2" />
                            <circle cx="8.5" cy="8.5" r="1.5" />
                            <polyline points="21 15 16 10 5 21" />
                        </svg>
                        <span class="text-sm">Gambar Osteobike</span>
                    </div>
                </div>
                {{-- Badge float --}}
                {{-- <div class="absolute -bottom-4 -left-4 px-4 py-2 rounded-xl shadow-md text-white text-xs font-semibold"
                    style="background: linear-gradient(135deg, #0EA5A4, #3B82F6);">
                    Inovasi Teknologi Kesehatan
                </div> --}}
            </div>

        </div>
    </div>

    {{-- Divider section --}}
    <div class="max-w-5xl mx-auto mb-14 flex items-center gap-4">
        <div class="h-px flex-1 bg-gray-100"></div>
        <p class="text-xs font-semibold tracking-[3px] uppercase text-gray-400">Tim Pengembang</p>
        <div class="h-px flex-1 bg-gray-100"></div>
    </div>

    {{-- ===== TIM ANGGOTA ===== --}}
    <div class="max-w-5xl mx-auto">

        <h2 class="text-center font-extrabold text-3xl md:text-4xl text-gray-900 mb-2">
            Kenalan dengan
            <span class="bg-gradient-to-r from-[#3B82F6] to-[#F59E0B] bg-clip-text text-transparent">
                Tim Kami
            </span>
        </h2>
        <p class="text-center text-gray-400 text-sm mb-12">Dosen & Mahasiswa yang mengembangkan Osteobike dari nol hingga siap
            pakai.</p>

        {{-- Grid anggota --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

            @php
                $anggota = [
                    [
                        'nama' => 'Menik Dwi Kurniatie S.Si.,M.Biotech',
                        'no' => 'NIP: 0686.11.2018.728',
                        'peran' => 'Pembimbing 1',
                        'foto' => '/images/tim/menik.jpeg',
                        'accent' => '#0EA5A4',
                    ],
                    [
                        'nama' => 'Hartanto Prawibowo, S.T., M.T..',
                        'no' => 'NIP: 199801302025061002',
                        'peran' => 'Pembimbing 2',
                        'foto' => '/images/tim/hartanto.jpeg',
                        'accent' => '#3B82F6',
                    ],
                    [
                        'nama' => 'M Salman Alfarisi',
                        'no' => 'NIM: E13.2022.00231',
                        'peran' => 'Mahasiswa',
                        'foto' => '/images/tim/salman.jpeg',
                        'accent' => '#F59E0B',
                    ],
                    [
                        'nama' => 'Maria Rency Mariska',
                        'no' => 'NIM: E13.2022.00245',
                        'peran' => 'Mahasiswa',
                        'foto' => '/images/tim/maria.jpeg',
                        'accent' => '#0EA5A4',
                    ],
                ];
            @endphp

            @foreach ($anggota as $index => $member)
                <div class="group bg-white border border-gray-100 rounded-2xl overflow-hidden
                        transition-all duration-300 hover:-translate-y-2 hover:shadow-xl"
                    style="--accent: {{ $member['accent'] }};">

                    {{-- Foto --}}
                    <div class="relative w-full aspect-square bg-gray-50 overflow-hidden">
                        <img src="{{ $member['foto'] }}" alt="{{ $member['nama'] }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        {{-- Fallback avatar --}}
                        <div class="hidden w-full h-full items-center justify-center text-white font-bold text-3xl"
                            style="background: linear-gradient(135deg, {{ $member['accent'] }}cc, {{ $member['accent'] }}66);">
                            {{ strtoupper(substr($member['nama'], 0, 2)) }}
                        </div>

                        {{-- Badge peran --}}
                        <span class="absolute top-3 left-3 text-[10px] font-semibold px-2 py-1 rounded-full text-white"
                            style="background-color: {{ $member['accent'] }};">
                            {{ $member['peran'] }}
                        </span>
                    </div>

                    {{-- Info --}}
                    <div class="p-4">
                        <h4 class="font-bold text-gray-900 text-sm leading-snug mb-1">{{ $member['nama'] }}</h4>
                        <p class="text-[11px] font-mono text-gray-400">{{ $member['no'] }}</p>
                    </div>

                    {{-- Bottom accent bar --}}
                    <div class="h-[3px] w-0 group-hover:w-full transition-all duration-500 rounded-b-2xl"
                        style="background-color: {{ $member['accent'] }};"></div>

                </div>
            @endforeach

        </div>
    </div>

</section>
