@extends('layouts.app')

@section('title', 'Pengingat Terapi')

@section('content')

    {{-- Header --}}
    <div class="flex items-start justify-between mb-5">
        <div>
            <h1 class="font-black text-xl text-slate-900" style="font-family:'Syne',sans-serif;">Pengingat Terapi</h1>
            <p class="text-xs text-slate-400 mt-0.5">{{ $total }} total pengingat terdaftar</p>
        </div>
        <a href="{{ route('pengingat-terapi.create') }}"
            class="inline-flex items-center gap-2 bg-[#0EA5A4] hover:bg-[#0c8f8e] text-white text-[13px] font-medium px-4 py-2.5 rounded-[9px] transition">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                stroke-linecap="round">
                <line x1="12" y1="5" x2="12" y2="19" />
                <line x1="5" y1="12" x2="19" y2="12" />
            </svg>
            Tambah Pengingat
        </a>
    </div>

    {{-- Flash success --}}
    @if (session('success'))
        <div
            class="mb-4 flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700 text-[13px] px-4 py-3 rounded-xl">
            <svg class="w-4 h-4 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Card Table --}}
    <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

        {{-- Toolbar --}}
        <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
            <form method="GET" action="{{ route('pengingat-terapi.index') }}" id="searchForm"
                class="flex items-center gap-3">

                {{-- Search --}}
                <div class="relative">
                    <svg class="absolute left-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <input type="text" name="search" id="searchInput" value="{{ request('search') }}"
                        placeholder="Cari nama pasien..." autocomplete="off"
                        class="pl-8 pr-8 py-2 text-[13px] border border-slate-200 rounded-lg outline-none w-60 bg-slate-50
                                  focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)]
                                  text-slate-700 placeholder:text-slate-400">
                    <svg id="searchSpinner"
                        class="absolute right-2.5 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-[#0EA5A4] hidden animate-spin"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path
                            d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83" />
                    </svg>
                </div>

                {{-- Filter Status --}}
                <select name="status" onchange="this.form.submit()"
                    class="py-2 pl-3 pr-8 text-[13px] border border-slate-200 rounded-lg outline-none bg-slate-50
                               focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)]
                               text-slate-700 cursor-pointer appearance-none">
                    <option value="">Semua Status</option>
                    <option value="belum" {{ request('status') === 'belum' ? 'selected' : '' }}>Belum</option>
                    <option value="sudah" {{ request('status') === 'sudah' ? 'selected' : '' }}>Sudah</option>
                </select>

            </form>
        </div>

        {{-- Table --}}
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100 text-[11px] text-slate-400 uppercase tracking-wide">
                    <th class="px-4 py-2.5 text-left w-8">#</th>
                    <th class="px-4 py-2.5 text-left">Pasien</th>
                    <th class="px-4 py-2.5 text-left">Tanggal Terapi</th>
                    <th class="px-4 py-2.5 text-center">Status</th>
                    <th class="px-4 py-2.5 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse ($pengingats as $i => $item)
                    <tr class="hover:bg-slate-50/60 transition">

                        <td class="px-4 py-3 text-slate-400 text-xs">{{ $pengingats->firstItem() + $i }}</td>

                        {{-- Pasien --}}
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-2.5">

                                {{-- Avatar --}}
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold text-[11px] flex-shrink-0 bg-[#0EA5A4]"
                                    style="font-family:'Syne',sans-serif;">
                                    {{ strtoupper(substr($item->user->nama_lengkap ?? '-', 0, 2)) }}
                                </div>

                                {{-- Info --}}
                                <div class="leading-tight">
                                    <div class="text-[13px] font-medium text-slate-900">
                                        {{ $item->user->nama_lengkap ?? '-' }}
                                    </div>

                                    <div class="text-[11px] text-slate-400">
                                        {{ $item->user->kode_pasien ?? '-' }} ·
                                        {{ $item->user->jenis_kelamin ?? '-' }}
                                    </div>
                                </div>

                            </div>
                        </td>

                        {{-- Tanggal --}}
                        <td class="px-4 py-3 text-[13px] text-slate-600">
                            {{ $item->tanggal_terapi_selanjutnya->format('d M Y, H:i') }}
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-3 text-center">
                            @if ($item->status === 'sudah')
                                <span
                                    class="inline-flex items-center gap-1 text-[11px] font-semibold px-2.5 py-1 rounded-full
                                             bg-emerald-50 border border-emerald-200 text-emerald-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                    Sudah
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1 text-[11px] font-semibold px-2.5 py-1 rounded-full
                                             bg-amber-50 border border-amber-200 text-amber-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                    Belum
                                </span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-1.5">
                                {{-- Show --}}
                                <button onclick="openShow({{ $item->id }})"
                                    class="w-7 h-7 flex items-center justify-center rounded-lg
                                               bg-[rgba(14,165,164,0.08)] border border-[rgba(14,165,164,0.2)]
                                               text-[#0c8f8e] hover:bg-[rgba(14,165,164,0.16)] transition"
                                    title="Lihat">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                        <circle cx="12" cy="12" r="3" />
                                    </svg>
                                </button>
                                {{-- Edit --}}
                                <a href="{{ route('pengingat-terapi.edit', $item->id) }}"
                                    class="w-7 h-7 flex items-center justify-center rounded-lg
                                          bg-[rgba(59,130,246,0.08)] border border-[rgba(59,130,246,0.2)]
                                          text-blue-600 hover:bg-[rgba(59,130,246,0.16)] transition"
                                    title="Edit">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                    </svg>
                                </a>
                                {{-- Delete --}}
                                <button
                                    onclick="openDelete('{{ route('pengingat-terapi.destroy', $item->id) }}', '{{ $item->user->nama_lengkap ?? '-' }}')"
                                    class="w-7 h-7 flex items-center justify-center rounded-lg
                                               bg-[rgba(239,68,68,0.08)] border border-[rgba(239,68,68,0.2)]
                                               text-red-500 hover:bg-[rgba(239,68,68,0.16)] transition"
                                    title="Hapus">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <polyline points="3 6 5 6 21 6" />
                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                        <path d="M10 11v6M14 11v6" />
                                    </svg>
                                </button>
                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-slate-400 text-sm">
                            <svg class="w-8 h-8 mx-auto mb-2 text-slate-300" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                            Tidak ada data pengingat ditemukan
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="flex items-center justify-between px-4 py-3 border-t border-slate-100">
            <span class="text-xs text-slate-400">
                @if ($pengingats->total() > 0)
                    Menampilkan {{ $pengingats->firstItem() }}–{{ $pengingats->lastItem() }} dari
                    {{ $pengingats->total() }} pengingat
                @else
                    Tidak ada data
                @endif
            </span>
            <div class="flex items-center gap-1">
                @if ($pengingats->onFirstPage())
                    <span
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-300 text-sm cursor-not-allowed">‹</span>
                @else
                    <a href="{{ $pengingats->previousPageUrl() }}"
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 text-sm">‹</a>
                @endif

                @foreach ($pengingats->getUrlRange(1, $pengingats->lastPage()) as $pg => $url)
                    @if ($pg == $pengingats->currentPage())
                        <span
                            class="w-8 h-8 flex items-center justify-center rounded-lg bg-[#0EA5A4] text-white text-[13px] font-medium">{{ $pg }}</span>
                    @else
                        <a href="{{ $url }}"
                            class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 text-[13px]">{{ $pg }}</a>
                    @endif
                @endforeach

                @if ($pengingats->hasMorePages())
                    <a href="{{ $pengingats->nextPageUrl() }}"
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 text-sm">›</a>
                @else
                    <span
                        class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-300 text-sm cursor-not-allowed">›</span>
                @endif
            </div>
        </div>
    </div>

    {{-- ============ MODAL SHOW ============ --}}
    <div id="showModal" class="fixed inset-0 bg-slate-900/50 z-50 flex items-center justify-center hidden"
        onclick="closeModal('showModal')">
        <div class="bg-white rounded-2xl border border-slate-200 w-[420px] overflow-hidden"
            onclick="event.stopPropagation()">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <span class="font-black text-base text-slate-900" style="font-family:'Syne',sans-serif;">Detail
                    Pengingat</span>
                <button onclick="closeModal('showModal')"
                    class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition">
                    <svg class="w-3.5 h-3.5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div id="showBody" class="p-5"></div>
            <div class="px-5 py-3 border-t border-slate-100 flex justify-end">
                <button onclick="closeModal('showModal')"
                    class="text-[13px] font-medium text-slate-500 px-4 py-2 rounded-lg border border-slate-200 hover:bg-slate-50 transition">Tutup</button>
            </div>
        </div>
    </div>

    {{-- ============ MODAL DELETE ============ --}}
    <div id="deleteModal" class="fixed inset-0 bg-slate-900/50 z-50 flex items-center justify-center hidden"
        onclick="closeModal('deleteModal')">
        <div class="bg-white rounded-2xl border border-slate-200 w-[400px] overflow-hidden"
            onclick="event.stopPropagation()">
            <div class="flex items-center justify-between px-5 py-4 border-b border-slate-100">
                <span class="font-black text-base text-red-600" style="font-family:'Syne',sans-serif;">Hapus
                    Pengingat</span>
                <button onclick="closeModal('deleteModal')"
                    class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center hover:bg-slate-200 transition">
                    <svg class="w-3.5 h-3.5 text-slate-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div class="p-5">
                <div class="flex items-start gap-3 bg-red-50 border border-red-100 rounded-xl p-3.5">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    <p class="text-[13px] text-red-800 leading-relaxed">
                        Yakin ingin menghapus pengingat untuk <strong id="deleteNama" class="text-red-700"></strong>?
                        Tindakan ini tidak dapat dibatalkan.
                    </p>
                </div>
            </div>
            <div class="px-5 py-3 border-t border-slate-100 flex justify-end gap-2">
                <button onclick="closeModal('deleteModal')"
                    class="text-[13px] font-medium text-slate-500 px-4 py-2 rounded-lg border border-slate-200 hover:bg-slate-50 transition">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-[13px] font-medium text-white px-4 py-2 rounded-lg bg-red-500 hover:bg-red-600 transition">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            const pengingatData = @json($pengingats->items());

            function openShow(id) {
                fetch(`/pengingat-terapi/${id}`, {
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(r => r.json())
                    .then(p => {
                        const initials = (p.user?.nama_lengkap ?? '-').split(' ').slice(0, 2).map(w => w[0]).join('')
                            .toUpperCase();
                        const statusBadge = p.status === 'sudah' ?
                            `<span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2.5 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>Sudah</span>` :
                            `<span class="inline-flex items-center gap-1 text-[11px] font-semibold px-2.5 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-700"><span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>Belum</span>`;

                        const rows = [
                            ['Nama Pasien', p.user?.nama_lengkap ?? '-'],
                            ['Tanggal Terapi', new Date(p.tanggal_terapi_selanjutnya).toLocaleString('id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric',
                                hour: '2-digit',
                                minute: '2-digit'
                            })],
                            ['Status', statusBadge],
                            ['Dibuat', new Date(p.created_at).toLocaleDateString('id-ID', {
                                day: '2-digit',
                                month: 'long',
                                year: 'numeric'
                            })],
                        ];

                        document.getElementById('showBody').innerHTML = `
                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-slate-100">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center text-white font-black text-base flex-shrink-0"
                             style="background:#0EA5A4;font-family:'Syne',sans-serif;">${initials}</div>
                        <div>
                            <div class="font-black text-[15px] text-slate-900" style="font-family:'Syne',sans-serif;">${p.user?.nama_lengkap ?? '-'}</div>
                            <div class="text-[12px] text-slate-400 mt-0.5">Pengingat Terapi</div>
                        </div>
                    </div>
                    <div class="space-y-2.5">
                        ${rows.map(([l,v]) => `
                                            <div class="flex items-start gap-2">
                                                <span class="text-[11px] text-slate-400 w-32 flex-shrink-0 pt-0.5">${l}</span>
                                                <span class="text-[13px] text-slate-800 font-medium flex-1">${v}</span>
                                            </div>`).join('')}
                    </div>`;

                        document.getElementById('showModal').classList.remove('hidden');
                    });
            }

            function openDelete(url, nama) {
                document.getElementById('deleteNama').textContent = nama;
                document.getElementById('deleteForm').action = url;
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeModal(id) {
                document.getElementById(id).classList.add('hidden');
            }

            // Search debounce
            const input = document.getElementById('searchInput');
            const form = document.getElementById('searchForm');
            const spin = document.getElementById('searchSpinner');
            let timer;
            input.addEventListener('input', () => {
                clearTimeout(timer);
                spin.classList.remove('hidden');
                timer = setTimeout(() => form.submit(), 500);
            });

            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    closeModal('showModal');
                    closeModal('deleteModal');
                }
            });
        </script>
    @endpush

@endsection
