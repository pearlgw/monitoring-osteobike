@extends('layouts.auth')

@section('content')
    <div class="min-h-screen bg-slate-100 flex items-center justify-center p-4">
        <div class="w-full max-w-4xl grid grid-cols-2 rounded-2xl overflow-hidden shadow-xl border border-black/8">

            {{-- === LEFT PANEL === --}}
            <div class="relative bg-[#0c1a2e] overflow-hidden p-10 flex flex-col justify-between">

                {{-- BG decorations --}}
                <div class="absolute inset-0"
                    style="background-image:linear-gradient(rgba(14,165,164,0.07) 1px,transparent 1px),linear-gradient(90deg,rgba(14,165,164,0.07) 1px,transparent 1px);background-size:40px 40px;">
                </div>
                <div class="absolute -bottom-24 -right-20 w-80 h-80 rounded-full pointer-events-none"
                    style="background:radial-gradient(circle,rgba(14,165,164,0.2) 0%,transparent 65%);"></div>
                <div class="absolute -top-16 -left-10 w-48 h-48 rounded-full pointer-events-none"
                    style="background:radial-gradient(circle,rgba(245,158,11,0.12) 0%,transparent 65%);"></div>

                <div class="relative z-10">
                    {{-- Brand --}}
                    <div class="flex items-center gap-2.5 mb-10">
                        <div class="w-9 h-9 bg-[#0EA5A4] rounded-[10px] flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none">
                                <path d="M5 16L5 8C5 6.9 5.9 6 7 6L17 6C18.1 6 19 6.9 19 8L19 16" stroke="white"
                                    stroke-width="2" stroke-linecap="round" />
                                <circle cx="12" cy="17" r="2.5" stroke="white" stroke-width="2" />
                                <path d="M5 16C5 16 6.5 14 12 14C17.5 14 19 16 19 16" stroke="white" stroke-width="2"
                                    stroke-linecap="round" />
                                <circle cx="7" cy="10" r="1" fill="white" />
                                <circle cx="12" cy="9" r="1" fill="white" />
                                <circle cx="17" cy="10" r="1" fill="white" />
                            </svg>
                        </div>
                        <span class="font-black text-lg text-white" style="font-family:'Syne',sans-serif;">Osteo<span
                                class="text-[#0EA5A4]">bike</span></span>
                    </div>

                    <h2 class="font-black text-[30px] text-white leading-tight tracking-tight mb-3"
                        style="font-family:'Syne',sans-serif;">
                        Monitor Kesehatan <span class="text-[#0EA5A4]">Sendi</span> Setiap Hari
                    </h2>
                    <p class="text-white/55 text-sm font-light leading-relaxed">
                        Lihat perkembangan latihan sendi dan kemajuan terapi Anda dengan mudah melalui dashboard OSTEOBIKE.
                    </p>
                </div>

                {{-- Feature list --}}
                <div class="relative z-10 space-y-3">
                    @foreach ([['icon' => 'M22 12h-4l-3 9L9 3l-3 9H2', 'title' => 'Real-time monitoring', 'desc' => 'sesi terapi aktif dan pasif'], ['icon' => 'M3 3h18v18H3zM8 17V13M12 17V9M16 17V13', 'title' => 'Laporan mingguan', 'desc' => 'perkembangan sendi'], ['icon' => 'M12 22c5.5-3 8-6.5 8-10V5l-8-3-8 3v7c0 3.5 2.5 7 8 10z', 'title' => 'Riwayat lengkap', 'desc' => 'seluruh sesi terapi']] as $feat)
                        <div class="flex items-center gap-3">
                            <div
                                class="w-7 h-7 rounded-lg bg-[rgba(14,165,164,0.15)] border border-[rgba(14,165,164,0.25)] flex items-center justify-center flex-shrink-0">
                                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="#0EA5A4"
                                    stroke-width="2.2" stroke-linecap="round">
                                    <path d="{{ $feat['icon'] }}" />
                                </svg>
                            </div>
                            <span class="text-white/60 text-[13px]"><span
                                    class="text-white/85 font-medium">{{ $feat['title'] }}</span> {{ $feat['desc'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- === RIGHT PANEL (Form) === --}}
            <div class="bg-white p-10 flex flex-col justify-center">

                <div
                    class="inline-flex items-center gap-1.5 bg-[rgba(14,165,164,0.08)] border border-[rgba(14,165,164,0.2)] rounded-full px-3 py-1 mb-4 w-fit">
                    <span class="w-1.5 h-1.5 bg-[#0EA5A4] rounded-full"></span>
                    <span class="text-[#0EA5A4] text-[11px] font-medium tracking-wide">Portal Osteobike</span>
                </div>

                <h2 class="font-black text-2xl text-slate-900 tracking-tight mb-1" style="font-family:'Syne',sans-serif;">
                    Selamat datang</h2>
                <p class="text-slate-400 text-[13px] mb-6">Masukkan kredensial Anda untuk mengakses dashboard</p>

                {{-- Status / session --}}
                @if (session('status'))
                    <div
                        class="flex items-center gap-2 bg-[rgba(14,165,164,0.07)] border border-[rgba(14,165,164,0.2)] rounded-lg px-3.5 py-2.5 mb-5">
                        <svg class="w-3.5 h-3.5 text-[#0EA5A4] flex-shrink-0" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                        <span class="text-[#0c8f8e] text-xs">{{ session('status') }}</span>
                    </div>
                @else
                    <div
                        class="flex items-center gap-2 bg-[rgba(14,165,164,0.07)] border border-[rgba(14,165,164,0.2)] rounded-lg px-3.5 py-2.5 mb-5">
                        <svg class="w-3.5 h-3.5 text-[#0EA5A4] flex-shrink-0" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                        </svg>
                        <span class="text-[#0c8f8e] text-xs">Koneksi aman & terenkripsi</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">Alamat
                            Email</label>
                        <div class="relative">
                            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                <polyline points="22,6 12,13 2,6" />
                            </svg>
                            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                placeholder="nama@email.com"
                                class="w-full pl-10 pr-4 py-2.5 text-sm text-slate-800 bg-slate-50 border-[1.5px] border-slate-200 rounded-[10px] outline-none transition focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] placeholder:text-slate-400">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="mb-5">
                        <div class="flex justify-between items-center mb-1.5">
                            <label class="text-[11px] font-medium text-slate-500 uppercase tracking-wide">Password</label>
                        </div>
                        <div class="relative">
                            <svg class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" />
                                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
                            </svg>
                            <input type="password" name="password" required placeholder="••••••••" id="pw-input"
                                class="w-full pl-10 pr-10 py-2.5 text-sm text-slate-800 bg-slate-50 border-[1.5px] border-slate-200 rounded-[10px] outline-none transition focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] placeholder:text-slate-400">
                            <button type="button" onclick="togglePw()"
                                class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600">
                                <svg id="eye-icon" class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-[#0EA5A4] hover:bg-[#0c8f8e] text-white text-sm font-medium py-3 rounded-[10px] transition hover:-translate-y-px mb-5">
                        Masuk
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round">
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <script>
        function togglePw() {
            const input = document.getElementById('pw-input');
            input.type = input.type === 'password' ? 'text' : 'password';
        }
    </script>
@endsection
