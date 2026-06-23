@extends('layouts.app')

@section('title', 'Tambah Terapi')

@section('content')

    <div class="mb-5">
        <a href="{{ route('terapi.index') }}"
            class="inline-flex items-center gap-1.5 text-[13px] text-slate-500 hover:text-slate-700 transition mb-3">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round">
                <line x1="19" y1="12" x2="5" y2="12" />
                <polyline points="12 19 5 12 12 5" />
            </svg>
            Kembali ke Data Terapi
        </a>
        <h1 class="font-black text-xl text-slate-900" style="font-family:'Syne',sans-serif;">Tambah Sesi Terapi</h1>
        <p class="text-xs text-slate-400 mt-0.5">Isi data sesi terapi dengan lengkap dan benar</p>
    </div>

    <form method="POST" action="{{ route('terapi.store') }}">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            <div class="lg:col-span-2 space-y-5">

                {{-- Data Pasien & Sesi --}}
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="px-5 py-3.5 border-b border-slate-100 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-md bg-[rgba(14,165,164,0.1)] flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-[#0EA5A4]" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                <circle cx="12" cy="7" r="4" />
                            </svg>
                        </div>
                        <span class="font-bold text-[13px] text-slate-800" style="font-family:'Syne',sans-serif;">Data
                            Pasien & Sesi</span>
                    </div>
                    <div class="p-5 grid grid-cols-2 gap-4">

                        {{-- Pasien --}}
                        <div class="col-span-2">
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Pasien <span class="text-red-400">*</span>
                            </label>
                            <select name="user_id" required
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] text-slate-700">
                                <option value="">Pilih pasien...</option>
                                @foreach ($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}"
                                        {{ old('user_id') == $pasien->id ? 'selected' : '' }}>
                                        {{ $pasien->kode_pasien }} - {{ $pasien->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tanggal Terapi --}}
                        <div>
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Tanggal Terapi <span class="text-red-400">*</span>
                            </label>
                            <input type="date" name="tanggal_terapi" value="{{ old('tanggal_terapi', date('Y-m-d')) }}"
                                required
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800">
                            @error('tanggal_terapi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Berat Badan --}}
                        <div>
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Berat Badan <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" name="berat_badan" value="{{ old('berat_badan') }}" required
                                    min="1"
                                    class="w-full px-3.5 py-2.5 pr-10 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800">
                                <span
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-[12px] text-slate-400">kg</span>
                            </div>
                            @error('berat_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Metode --}}
                        <div>
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Metode <span class="text-red-400">*</span>
                            </label>
                            <select name="metode" required id="metodeSelect"
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] text-slate-700">
                                <option value="">Pilih metode...</option>
                                <option value="Pasif" {{ old('metode') === 'Pasif' ? 'selected' : '' }}>Pasif</option>
                                <option value="Aktif" {{ old('metode') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            </select>
                            @error('metode')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @include('pages.terapi.partials.vas', ['value' => null])

                        {{-- Diagnosa --}}
                        <div class="col-span-2">
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Diagnosa <span class="text-red-400">*</span>
                            </label>
                            <textarea name="diagnosa" rows="3" required placeholder="Tuliskan diagnosa pasien..."
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800 placeholder:text-slate-400 resize-none">{{ old('diagnosa') }}</textarea>
                            @error('diagnosa')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                {{-- Data Klinis --}}
                <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">
                    <div class="px-5 py-3.5 border-b border-slate-100 flex items-center gap-2">
                        <div class="w-6 h-6 rounded-md bg-[rgba(59,130,246,0.1)] flex items-center justify-center">
                            <svg class="w-3.5 h-3.5 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round">
                                <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
                            </svg>
                        </div>
                        <span class="font-bold text-[13px] text-slate-800" style="font-family:'Syne',sans-serif;">Data
                            Klinis</span>
                    </div>
                    <div class="p-5 grid grid-cols-2 gap-4">

                        {{-- RPM (hanya Aktif) --}}
                        <div id="rpmField">
                            <label
                                class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">RPM</label>
                            <input type="number" name="rpm" value="{{ old('rpm') }}" min="0"
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800"
                                placeholder="0">
                            @error('rpm')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Durasi --}}
                        <div>
                            <label
                                class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">Durasi</label>
                            <div class="relative">
                                <input type="number" name="durasi" value="{{ old('durasi') }}" min="0"
                                    class="w-full px-3.5 py-2.5 pr-12 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800"
                                    placeholder="0">
                                <span
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-[12px] text-slate-400">menit</span>
                            </div>
                            @error('durasi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @if (config('app.activate_rom'))
                            <div class="col-span-2">
                                <label
                                    class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">ROM</label>
                                <input type="text" name="rom" value="{{ old('rom') }}"
                                    placeholder="Contoh: 0-120°"
                                    class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800 placeholder:text-slate-400">
                                @error('rom')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- Sidebar --}}
            <div class="space-y-4">
                <div class="bg-white rounded-xl border border-slate-200 p-4">
                    <p class="font-bold text-[13px] text-slate-800 mb-3" style="font-family:'Syne',sans-serif;">Panduan
                        Pengisian</p>
                    <div class="space-y-2.5 text-[12px] text-slate-500 leading-relaxed">
                        <p>• Field bertanda <span class="text-red-400 font-medium">*</span> wajib diisi</p>
                        <p>• RPM hanya diisi untuk metode <strong class="text-slate-700">Aktif</strong></p>
                        @if (config('app.activate_rom'))
                            <p>• ROM diisi dalam format derajat, misal <span class="font-mono text-slate-600">0-120°</span></p>
                        @endif
                        <p>• Durasi dalam satuan menit</p>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-slate-200 p-4 flex flex-col gap-2">
                    <button type="submit"
                        class="w-full flex items-center justify-center gap-2 bg-[#0EA5A4] hover:bg-[#0c8f8e] text-white text-[13px] font-medium py-2.5 rounded-[9px] transition">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.5" stroke-linecap="round">
                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z" />
                            <polyline points="17 21 17 13 7 13 7 21" />
                            <polyline points="7 3 7 8 15 8" />
                        </svg>
                        Simpan Terapi
                    </button>
                    <a href="{{ route('terapi.index') }}"
                        class="w-full flex items-center justify-center text-[13px] font-medium text-slate-500 border border-slate-200 py-2.5 rounded-[9px] hover:bg-slate-50 transition">
                        Batal
                    </a>
                </div>
            </div>

        </div>
    </form>

@endsection
