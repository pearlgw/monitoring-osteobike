@extends('layouts.app')

@section('title', 'Laporan Terapi')

@section('content')

    {{-- Header --}}
    <div class="mb-5">
        <h1 class="font-black text-xl text-slate-900">Laporan Terapi</h1>
        <p class="text-xs text-slate-400 mt-0.5">Filter berdasarkan kode pasien dan rentang tanggal</p>
    </div>

    {{-- Form Filter --}}
    <div class="bg-white rounded-xl border border-slate-200 p-5 mb-5">
        <form method="POST" action="{{ route('laporan-admin.filter') }}">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-3 items-end">

                {{-- Kode Pasien --}}
                <div>
                    <label class="block text-[11px] text-slate-500 font-medium mb-1.5 tracking-wide uppercase">
                        Kode Pasien
                    </label>
                    <input type="text" name="kode_pasien" value="{{ old('kode_pasien', $kode_pasien ?? '') }}"
                        placeholder="Contoh: PSN001"
                        class="w-full border border-slate-200 rounded-[9px] px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-[#0EA5A4]/30 focus:border-[#0EA5A4] transition" />
                    @error('kode_pasien')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Start --}}
                <div>
                    <label class="block text-[11px] text-slate-500 font-medium mb-1.5 tracking-wide uppercase">
                        Tanggal Mulai
                    </label>
                    <input type="date" name="tanggal_start" id="tanggalStart"
                        value="{{ old('tanggal_start', $tanggal_start ?? '') }}" max="{{ now()->toDateString() }}"
                        class="w-full border border-slate-200 rounded-[9px] px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#0EA5A4]/30 focus:border-[#0EA5A4] transition" />
                    @error('tanggal_start')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal Akhir --}}
                <div>
                    <label class="block text-[11px] text-slate-500 font-medium mb-1.5 tracking-wide uppercase">
                        Tanggal Akhir
                    </label>
                    <input type="date" name="tanggal_akhir" id="tanggalAkhir"
                        value="{{ old('tanggal_akhir', $tanggal_akhir ?? now()->toDateString()) }}"
                        min="{{ old('tanggal_start', $tanggal_start ?? '') }}" max="{{ now()->toDateString() }}"
                        class="w-full border border-slate-200 rounded-[9px] px-3 py-2.5 text-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-[#0EA5A4]/30 focus:border-[#0EA5A4] transition" />
                    @error('tanggal_akhir')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div>
                    <button type="submit"
                        class="w-full inline-flex items-center justify-center gap-2 bg-[#0EA5A4] hover:bg-[#0c8f8e] text-white text-sm font-medium px-5 py-2.5 rounded-[9px] transition hover:-translate-y-px">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.35-4.35" />
                        </svg>
                        Tampilkan Grafik
                    </button>
                </div>

            </div>
        </form>
    </div>

    {{-- Info Pasien (muncul setelah filter) --}}
    @isset($pasien)
        <div
            class="flex items-center gap-3 bg-[rgba(14,165,164,0.06)] border border-[rgba(14,165,164,0.2)] rounded-xl px-4 py-3 mb-5">
            <div
                class="w-9 h-9 rounded-lg bg-[#0EA5A4] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                {{ strtoupper(substr($pasien->nama_lengkap, 0, 2)) }}
            </div>
            <div>
                <p class="text-sm font-semibold text-slate-800">{{ $pasien->nama_lengkap }}</p>
                <p class="text-[11px] text-slate-400">{{ $pasien->kode_pasien }} · {{ $pasien->jenis_kelamin ?? '-' }}</p>
            </div>
            <div class="ml-auto text-right">
                <p class="text-[11px] text-slate-400">Rentang Terapi</p>
                <p class="text-xs font-medium text-slate-700">
                    {{ \Carbon\Carbon::parse($tanggal_start)->isoFormat('D MMM YYYY') }}
                    –
                    {{ \Carbon\Carbon::parse($tanggal_akhir)->isoFormat('D MMM YYYY') }}
                </p>
            </div>
        </div>
    @endisset

    {{-- Grafik (muncul setelah filter) --}}
    @isset($chartLabels)
        @if (count($chartLabels) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">

                {{-- Grafik Durasi --}}
                <div class="bg-white rounded-xl border border-slate-200 p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-sm text-slate-900">Grafik Durasi</h2>
                        <span class="flex items-center gap-1.5 text-xs text-slate-500">
                            <span class="w-2.5 h-2.5 rounded-sm bg-[#0EA5A4]"></span>menit
                        </span>
                    </div>
                    <div style="position:relative;width:100%;height:240px;">
                        <canvas id="durasiChart" role="img" aria-label="Grafik durasi terapi per tanggal"></canvas>
                    </div>
                </div>

                {{-- Grafik RPM --}}
                <div class="bg-white rounded-xl border border-slate-200 p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="font-bold text-sm text-slate-900">Grafik RPM</h2>
                        <span class="flex items-center gap-1.5 text-xs text-slate-500">
                            <span class="w-2.5 h-2.5 rounded-sm border-2 border-dashed border-[#3B82F6]"></span>rpm
                        </span>
                    </div>
                    <div style="position:relative;width:100%;height:240px;">
                        <canvas id="rpmChart" role="img" aria-label="Grafik RPM terapi per tanggal"></canvas>
                    </div>
                </div>

            </div>
        @else
            <div class="bg-white rounded-xl border border-slate-200 p-10 text-center">
                <svg class="w-10 h-10 mx-auto mb-3 text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round">
                    <path d="M3 3v18h18" />
                    <path d="m19 9-5 5-4-4-3 3" />
                </svg>
                <p class="text-sm text-slate-400">Tidak ada data terapi pada rentang tanggal tersebut.</p>
            </div>
        @endif
    @endisset

    @isset($kode_pasien, $tanggal_start, $tanggal_akhir)
        <form method="POST" action="{{ route('laporan-admin.download') }}" id="downloadForm">
            @csrf

            <input type="hidden" name="kode_pasien" value="{{ $kode_pasien }}">
            <input type="hidden" name="tanggal_start" value="{{ $tanggal_start }}">
            <input type="hidden" name="tanggal_akhir" value="{{ $tanggal_akhir }}">

            <input type="hidden" name="chart_durasi_img" id="chartDurasiImg">
            <input type="hidden" name="chart_rpm_img" id="chartRpmImg">

            <button type="button" onclick="downloadPDF()"
                class="mt-4 inline-flex items-center gap-2 bg-[#0EA5A4] text-white px-4 py-2 rounded-lg">
                Download PDF
            </button>
        </form>
    @endisset

@endsection

@push('scripts')
    <script>
        (function() {
            const tanggalStart = document.getElementById('tanggalStart');
            const tanggalAkhir = document.getElementById('tanggalAkhir');

            if (!tanggalStart || !tanggalAkhir) {
                return;
            }

            const today = tanggalAkhir.max;
            tanggalStart.max = today;
            tanggalAkhir.max = today;

            function syncTanggalAkhirMin() {
                tanggalAkhir.min = tanggalStart.value || '';

                if (tanggalAkhir.value > today) {
                    tanggalAkhir.value = today;
                }

                if (tanggalStart.value && tanggalAkhir.value && tanggalAkhir.value < tanggalStart.value) {
                    tanggalAkhir.value = '';
                }
            }

            syncTanggalAkhirMin();
            tanggalStart.addEventListener('change', syncTanggalAkhirMin);
        })();
    </script>

    @isset($chartLabels)
        @if (count($chartLabels) > 0)
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
            <script>
                (function() {
                    const labels = {!! json_encode($chartLabels) !!};
                    const durasi = {!! json_encode($chartDurasi) !!};
                    const rpm = {!! json_encode($chartRpm) !!};

                    const axisEndpointLabels = {
                        id: 'axisEndpointLabels',
                        afterDraw(chart) {
                            const {
                                ctx,
                                chartArea: {
                                    left,
                                    right,
                                    top,
                                    bottom
                                }
                            } = chart;

                            ctx.save();
                            ctx.fillStyle = '#64748b';
                            ctx.font = '600 12px sans-serif';
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';
                            ctx.fillText('Y', left, top - 10);
                            ctx.fillText('X', right + 12, bottom);
                            ctx.restore();
                        }
                    };

                    const commonOptions = {
                        responsive: true,
                        maintainAspectRatio: false,
                        layout: {
                            padding: {
                                top: 28,
                                right: 36,
                                bottom: 8
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                backgroundColor: '#fff',
                                titleColor: '#0f172a',
                                bodyColor: '#64748b',
                                borderColor: '#e2e8f0',
                                borderWidth: 1,
                                padding: 10,
                            }
                        },
                        scales: {
                            x: {
                                grid: {
                                    color: 'rgba(0,0,0,0.04)'
                                },
                                title: {
                                    display: true,
                                    text: 'Tanggal',
                                    color: '#64748b',
                                    font: {
                                        size: 12,
                                        weight: '600'
                                    }
                                },
                                ticks: {
                                    font: {
                                        size: 11
                                    },
                                    color: '#94a3b8',
                                    maxRotation: 45
                                }
                            },
                            y: {
                                min: 0,
                                max: 60,
                                grid: {
                                    color: 'rgba(0,0,0,0.04)'
                                },
                                ticks: {
                                    font: {
                                        size: 11
                                    },
                                    color: '#94a3b8',
                                    stepSize: 10
                                }
                            }
                        }
                    };

                    const chartOptions = (yAxisTitle, tooltipLabel) => ({
                        ...commonOptions,
                        scales: {
                            ...commonOptions.scales,
                            y: {
                                ...commonOptions.scales.y,
                                title: {
                                    display: true,
                                    text: yAxisTitle,
                                    color: '#64748b',
                                    font: {
                                        size: 12,
                                        weight: '600'
                                    }
                                }
                            }
                        },
                        plugins: {
                            ...commonOptions.plugins,
                            tooltip: {
                                ...commonOptions.plugins.tooltip,
                                callbacks: {
                                    label: tooltipLabel
                                }
                            }
                        }
                    });

                    // Grafik Durasi
                    new Chart(document.getElementById('durasiChart'), {
                        type: 'line',
                        plugins: [axisEndpointLabels],
                        data: {
                            labels,
                            datasets: [{
                                label: 'Durasi (menit)',
                                data: durasi,
                                borderColor: '#0EA5A4',
                                backgroundColor: 'rgba(14,165,164,0.08)',
                                borderWidth: 2,
                                pointBackgroundColor: '#0EA5A4',
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: chartOptions('Menit', (ctx) => ctx.parsed.y === 0 ?
                            'Durasi: tidak ada data' : 'Durasi: ' + ctx.parsed.y + ' menit')
                    });

                    // Grafik RPM
                    new Chart(document.getElementById('rpmChart'), {
                        type: 'line',
                        plugins: [axisEndpointLabels],
                        data: {
                            labels,
                            datasets: [{
                                label: 'RPM',
                                data: rpm,
                                borderColor: '#3B82F6',
                                borderDash: [5, 4],
                                backgroundColor: 'rgba(59,130,246,0.06)',
                                borderWidth: 2,
                                pointBackgroundColor: '#3B82F6',
                                pointStyle: 'rectRot',
                                pointRadius: 4,
                                pointHoverRadius: 6,
                                fill: true,
                                tension: 0.4
                            }]
                        },
                        options: chartOptions('RPM', (ctx) => ctx.parsed.y === 0 ?
                            'RPM: tidak ada data' : 'RPM: ' + ctx.parsed.y + ' rpm')
                    });
                })();
            </script>
            <script>
                function downloadPDF() {
                    const durasiCanvas = document.getElementById('durasiChart');
                    const rpmCanvas = document.getElementById('rpmChart');

                    document.getElementById('chartDurasiImg').value = durasiCanvas.toDataURL('image/png');
                    document.getElementById('chartRpmImg').value = rpmCanvas.toDataURL('image/png');

                    document.getElementById('downloadForm').submit();
                }
            </script>
        @endif
    @endisset


@endpush
