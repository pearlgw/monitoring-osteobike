@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

    {{-- Header --}}
    <div class="mb-5">
        <div>
            <h1 class="font-black text-xl text-slate-900">Dashboard</h1>
            <p class="text-xs text-slate-400 mt-0.5">{{ now()->isoFormat('dddd, D MMMM YYYY') }} · Data diperbarui baru saja
            </p>
        </div>
    </div>

    {{-- ===== BARIS 1: Stat Cards + Pasien Terbaru ===== --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-3 mb-4">

        @php
            $stats = [
                [
                    'label' => 'Total Pasien',
                    'val' => $totalPasien,
                    'unit' => 'orang',
                    'trend' => 'Data real',
                    'trend_color' => 'text-emerald-500',
                    'icon_bg' => 'bg-[rgba(14,165,164,0.1)]',
                    'icon_stroke' => '#0EA5A4',
                    'icon' =>
                        '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
                ],
                [
                    'label' => 'Total Terapi',
                    'val' => $totalTerapi,
                    'unit' => 'sesi',
                    'trend' => 'Data real',
                    'trend_color' => 'text-emerald-500',
                    'icon_bg' => 'bg-[rgba(59,130,246,0.1)]',
                    'icon_stroke' => '#3B82F6',
                    'icon' => '<polyline points="22,12 18,12 15,21 9,3 6,12 2,12"/>',
                ],
                [
                    'label' => 'Rata-rata Durasi',
                    'val' => number_format($avgDurasi ?? 0, 0),
                    'unit' => 'menit',
                    'trend' => 'Data real',
                    'trend_color' => 'text-emerald-500',
                    'icon_bg' => 'bg-[rgba(245,158,11,0.1)]',
                    'icon_stroke' => '#F59E0B',
                    'icon' => '<circle cx="12" cy="12" r="10"/><polyline points="12,6 12,12 16,14"/>',
                ],
                [
                    'label' => 'Rata-rata RPM',
                    'val' => number_format($avgRpm ?? 0, 0),
                    'unit' => 'rpm',
                    'trend' => 'Data real',
                    'trend_color' => 'text-amber-500',
                    'icon_bg' => 'bg-[rgba(239,68,68,0.1)]',
                    'icon_stroke' => '#ef4444',
                    'icon' => '<path d="M22 12h-4l-3 9L9 3l-3 9H2"/>',
                ],
            ];
        @endphp

        @foreach ($stats as $s)
            <div class="bg-white rounded-xl border border-slate-200 p-4">
                <div class="w-[34px] h-[34px] rounded-[9px] {{ $s['icon_bg'] }} flex items-center justify-center mb-3">
                    <svg class="w-[17px] h-[17px]" viewBox="0 0 24 24" fill="none" stroke="{{ $s['icon_stroke'] }}"
                        stroke-width="2" stroke-linecap="round">{!! $s['icon'] !!}</svg>
                </div>
                <p class="text-[11px] text-slate-400 tracking-wide mb-1">{{ $s['label'] }}</p>
                <p class="font-black text-2xl text-slate-900 leading-none">
                    {{ $s['val'] }} <span class="text-[13px] font-normal text-slate-500">{{ $s['unit'] }}</span>
                </p>
                <p class="text-[11px] mt-1.5 {{ $s['trend_color'] }}">{{ $s['trend'] }}</p>
            </div>
        @endforeach

        {{-- Pasien Terbaru (kolom ke-5) --}}
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <p class="text-[11px] text-slate-400 tracking-wide mb-3">Pasien Terbaru</p>

            @if ($lastPasien)
                <div class="flex items-center gap-3 mb-3">
                    <div
                        class="w-10 h-10 rounded-lg bg-[#0EA5A4] flex items-center justify-center text-white font-bold text-sm flex-shrink-0">
                        {{ strtoupper(substr($lastPasien->nama_lengkap, 0, 2)) }}
                    </div>
                    <div>
                        <p class="text-[13px] font-semibold text-slate-800 leading-tight">{{ $lastPasien->nama_lengkap }}
                        </p>
                        <p class="text-[11px] text-slate-400 mt-0.5">{{ $lastPasien->kode_pasien ?? '-' }} ·
                            {{ $lastPasien->jenis_kelamin ?? '-' }}</p>
                    </div>
                </div>
                <p class="text-[11px] text-slate-400">Ditambahkan {{ $lastPasien->created_at->diffForHumans() }}</p>
            @else
                <p class="text-xs text-slate-400">Belum ada data pasien</p>
            @endif
        </div>

    </div>

    {{-- ===== BARIS 2: 2 Grafik Full Width ===== --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">

        {{-- Grafik Durasi --}}
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-sm text-slate-900">Grafik Durasi Exercise (7 Hari)</h2>
                <span class="flex items-center gap-1.5 text-xs text-slate-500">
                    <span class="w-2.5 h-2.5 rounded-sm bg-[#0EA5A4]"></span>Menit
                </span>
            </div>
            <div style="position:relative;width:100%;height:240px;">
                <canvas id="durasiChart" role="img" aria-label="Grafik durasi terapi 7 hari terakhir"></canvas>
            </div>
        </div>

        {{-- Grafik RPM --}}
        <div class="bg-white rounded-xl border border-slate-200 p-4">
            <div class="flex items-center justify-between mb-4">
                <h2 class="font-bold text-sm text-slate-900">Grafik Rpm(<i>Rotation per Minute</i>) Exercise (7 Hari)</h2>
                <span class="flex items-center gap-1.5 text-xs text-slate-500">
                    <span class="w-2.5 h-2.5 rounded-sm border-2 border-dashed border-[#3B82F6]"></span>RPM
                </span>
            </div>
            <div style="position:relative;width:100%;height:240px;">
                <canvas id="rpmChart" role="img" aria-label="Grafik RPM terapi 7 hari terakhir"></canvas>
            </div>
        </div>

    </div>

    <!-- <div class="flex justify-center mt-6">
        <form method="POST">
            @csrf
            <button type="submit"
                class="inline-flex items-center justify-center gap-3 bg-red-500 hover:bg-red-600 text-white text-base font-bold px-10 py-4 rounded-[10px] shadow-sm transition hover:-translate-y-px min-w-[260px]">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                    stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" />
                </svg>
                Emergency Stop
            </button>
        </form>
    </div> -->

    @push('scripts')
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
                        ctx.font = '600 13px sans-serif';
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
                                text: 'Sesi Exercise',
                                color: '#64748b',
                                font: {
                                    size: 13,
                                    weight: '600'
                                }
                            },
                            ticks: {
                                font: {
                                    size: 12
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
                                    size: 12
                                },
                                color: '#94a3b8',
                                stepSize: 10
                            }
                        }
                    }
                };

                const chartOptions = (yAxisTitle, tooltipLabel, yMax, yStepSize, yAxisTitleFontSize = 13) => ({
                    ...commonOptions,
                    plugins: {
                        ...commonOptions.plugins,
                        tooltip: {
                            ...commonOptions.plugins.tooltip,
                            callbacks: {
                                label: tooltipLabel
                            }
                        }
                    },
                    scales: {
                        ...commonOptions.scales,
                        y: {
                            ...commonOptions.scales.y,
                            max: yMax,
                            ticks: {
                                ...commonOptions.scales.y.ticks,
                                stepSize: yStepSize
                            },
                            title: {
                                display: true,
                                text: yAxisTitle,
                                color: '#64748b',
                                font: {
                                    size: yAxisTitleFontSize,
                                    weight: '600'
                                }
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
                    options: chartOptions('Durasi (menit) Exercise', (ctx) => ctx.parsed.y === 0 ?
                        'Durasi: tidak ada data' : 'Durasi: ' + ctx.parsed.y + ' menit', 30, 5)
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
                    options: chartOptions('RPM (<i>Rotation Per Minute</i>) Exercise', (ctx) => ctx.parsed.y === 0 ?
                        'RPM: tidak ada data' : 'RPM: ' + ctx.parsed.y + ' rpm', 60, 10, 10)
                });
            })();
        </script>
    @endpush

@endsection
