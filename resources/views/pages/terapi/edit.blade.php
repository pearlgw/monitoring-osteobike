@extends('layouts.app')

@section('title', 'Edit Terapi')

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
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#0EA5A4] flex items-center justify-center text-white font-black text-sm flex-shrink-0"
                style="font-family:'Syne',sans-serif;">
                {{ strtoupper(substr($terapi->user->nama_lengkap ?? 'T', 0, 2)) }}
            </div>
            <div>
                <h1 class="font-black text-xl text-slate-900" style="font-family:'Syne',sans-serif;">Edit Terapi</h1>
                <p class="text-xs text-slate-400">{{ $terapi->user->nama_lengkap ?? '-' }} · Terakhir diubah
                    {{ $terapi->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('terapi.update', $terapi->id) }}">
        @csrf
        @method('PUT')

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

                        <div class="col-span-2">
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Pasien <span class="text-red-400">*</span>
                            </label>
                            <select name="user_id" required
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] text-slate-700">
                                @foreach ($pasiens as $pasien)
                                    <option value="{{ $pasien->id }}"
                                        {{ old('user_id', $terapi->user_id) == $pasien->id ? 'selected' : '' }}>
                                        {{ $pasien->kode_pasien }} — {{ $pasien->nama_lengkap }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Tanggal Terapi <span class="text-red-400">*</span>
                            </label>
                            <input type="date" name="tanggal_terapi"
                                value="{{ old('tanggal_terapi', $terapi->tanggal_terapi) }}" required
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800">
                            @error('tanggal_terapi')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Berat Badan <span class="text-red-400">*</span>
                            </label>
                            <div class="relative">
                                <input type="number" name="berat_badan"
                                    value="{{ old('berat_badan', $terapi->berat_badan) }}" required min="1"
                                    class="w-full px-3.5 py-2.5 pr-10 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800">
                                <span
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-[12px] text-slate-400">kg</span>
                            </div>
                            @error('berat_badan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Metode <span class="text-red-400">*</span>
                            </label>
                            <select name="metode" required id="metodeSelect"
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] text-slate-700">
                                <option value="Pasif" {{ old('metode', $terapi->metode) === 'Pasif' ? 'selected' : '' }}>
                                    Pasif</option>
                                <option value="Aktif" {{ old('metode', $terapi->metode) === 'Aktif' ? 'selected' : '' }}>
                                    Aktif</option>
                            </select>
                            @error('metode')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-span-2">
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Diagnosa <span class="text-red-400">*</span>
                            </label>
                            <textarea name="diagnosa" rows="3" required
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800 resize-none">{{ old('diagnosa', $terapi->diagnosa) }}</textarea>
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

                        <div id="rpmField">
                            <label
                                class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">RPM</label>
                            <input type="number" name="rpm" value="{{ old('rpm', $terapi->rpm) }}" min="0"
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800">
                            @error('rpm')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">Durasi</label>
                            <div class="relative">
                                <input type="number" name="durasi" value="{{ old('durasi', $terapi->durasi) }}"
                                    min="0"
                                    class="w-full px-3.5 py-2.5 pr-12 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800">
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
                                <input type="text" name="rom" value="{{ old('rom', $terapi->rom) }}"
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
                    <p class="text-[11px] text-slate-400 uppercase tracking-wide font-medium mb-3">Info Record</p>
                    <div class="space-y-2.5 text-[12px]">
                        <div class="flex justify-between">
                            <span class="text-slate-400">ID Terapi</span>
                            <span
                                class="font-medium text-slate-700">#{{ str_pad($terapi->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Pasien</span>
                            <span class="font-medium text-slate-700">{{ $terapi->user->kode_pasien ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Dibuat</span>
                            <span class="font-medium text-slate-700">{{ $terapi->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Diperbarui</span>
                            <span class="font-medium text-slate-700">{{ $terapi->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl border border-slate-200 p-4">
                    <p class="font-bold text-[13px] text-slate-800 mb-3" style="font-family:'Syne',sans-serif;">Panduan
                        Pengisian</p>
                    <div class="space-y-2.5 text-[12px] text-slate-500 leading-relaxed">
                        <p>• Field bertanda <span class="text-red-400 font-medium">*</span> wajib diisi</p>
                        <p>• RPM hanya diisi untuk metode <strong class="text-slate-700">Aktif</strong></p>
                        @if (config('app.activate_rom'))
                            <p>• ROM diisi dalam format derajat</p>
                        @endif
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
                        Simpan Perubahan
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
