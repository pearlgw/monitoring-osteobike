<section class="relative py-20 px-6 overflow-hidden bg-white" id="about">

    {{-- Background blobs --}}
    <div class="absolute -top-16 -left-16 w-72 h-72 rounded-full opacity-10 blur-3xl pointer-events-none"
        style="background-color: #0EA5A4;"></div>
    <div class="absolute -bottom-12 -right-12 w-60 h-60 rounded-full opacity-10 blur-3xl pointer-events-none"
        style="background-color: #3B82F6;"></div>

    {{-- ===== BUKU PANDUAN ===== --}}
    <div class="max-w-5xl mx-auto mb-20">

        <div class="text-center mb-10">
            <p class="text-xs font-semibold tracking-[3px] uppercase mb-3" style="color: #0EA5A4;">Dokumentasi</p>
            <h2 class="font-extrabold text-3xl md:text-4xl text-gray-900 mb-4">
                Buku
                <span class="bg-gradient-to-r from-[#0EA5A4] to-[#3B82F6] bg-clip-text text-transparent">
                    Panduan
                </span>
            </h2>
            <p class="text-gray-500 max-w-2xl mx-auto text-sm">
                Pelajari lebih lanjut tentang Osteobike melalui buku panduan komprehensif kami. Anda dapat membaca panduan secara langsung atau mengunduhnya untuk dibaca secara offline.
            </p>
        </div>

        {{-- PDF Preview & Download Button --}}
        <div class="bg-white rounded-3xl p-4 md:p-6 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-gray-100">
            {{-- Toolbar with Download button --}}
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 px-2">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-teal-50 rounded-xl text-[#0EA5A4]">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">Buku Panduan Osteobike</h3>
                        <p class="text-xs font-medium text-gray-500 mt-0.5">Dokumen PDF • 17 MB</p>
                    </div>
                </div>
                <a href="{{ asset('file/BUKU_PANDUAN_OSTEOBIKE.pdf') }}" download
                    class="inline-flex self-start sm:self-center items-center justify-center gap-2 rounded-full px-5 py-2.5 text-sm font-bold text-white shadow-[0_4px_14px_0_rgba(14,165,164,0.39)] transition-all duration-300 hover:-translate-y-1 hover:scale-105 hover:shadow-[0_6px_20px_rgba(14,165,164,0.23)]"
                    style="background: linear-gradient(135deg, #0EA5A4, #3B82F6);">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                    </svg>
                    Download
                </a>
            </div>

            {{-- PDF Preview --}}
            <div class="relative w-full rounded-2xl overflow-hidden bg-gray-50 border border-gray-100 shadow-inner">
                <iframe 
                    src="{{ asset('file/BUKU_PANDUAN_OSTEOBIKE.pdf') }}#toolbar=0" 
                    class="w-full border-none h-[500px] md:h-[700px]"
                    title="Preview Buku Panduan Osteobike">
                </iframe>
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
