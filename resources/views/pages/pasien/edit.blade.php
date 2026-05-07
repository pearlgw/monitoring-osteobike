@extends('layouts.app')

@section('title', 'Edit Pasien')

@section('content')

    <div class="mb-5">
        <a href="{{ route('pasien.index') }}"
            class="inline-flex items-center gap-1.5 text-[13px] text-slate-500 hover:text-slate-700 transition mb-3">
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round">
                <line x1="19" y1="12" x2="5" y2="12" />
                <polyline points="12 19 5 12 12 5" />
            </svg>
            Kembali ke Data Pasien
        </a>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#0EA5A4] flex items-center justify-center text-white font-black text-sm flex-shrink-0"
                style="font-family:'Syne',sans-serif;">
                {{ strtoupper(substr($pasien->nama_lengkap, 0, 2)) }}
            </div>
            <div>
                <h1 class="font-black text-xl text-slate-900" style="font-family:'Syne',sans-serif;">Edit Pasien</h1>
                <p class="text-xs text-slate-400">{{ $pasien->nama_lengkap }} · Terakhir diubah
                    {{ $pasien->updated_at->diffForHumans() }}</p>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('pasien.update', $pasien->id) }}">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">

            {{-- Main Form --}}
            <div class="lg:col-span-2 space-y-5">

                {{-- Data Pribadi --}}
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
                            Pribadi</span>
                    </div>
                    <div class="p-5 grid grid-cols-2 gap-4">

                        {{-- Nama Lengkap --}}
                        <div class="col-span-2">
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Nama Lengkap <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="nama_lengkap"
                                value="{{ old('nama_lengkap', $pasien->nama_lengkap) }}" required
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800">
                            @error('nama_lengkap')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Email
                            </label>
                            <input type="email" name="email" value="{{ old('email', $pasien->email) }}"
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800">
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Umur --}}
                        <div>
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Umur
                            </label>
                            <input type="number" name="umur" value="{{ old('umur', $pasien->umur) }}" min="1"
                                max="120"
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800">
                            @error('umur')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Password + Jenis Kelamin --}}
                        <div class="col-span-2 grid grid-cols-2 gap-4">

                            {{-- Password --}}
                            <div>
                                <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                    Password Baru
                                    <span class="text-slate-400 normal-case font-normal">(kosongkan jika tidak
                                        diubah)</span>
                                </label>

                                <input type="password" name="password" autocomplete="new-password" placeholder="••••••••"
                                    class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50
            focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800
            placeholder:text-slate-400">

                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div>
                                <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                    Jenis Kelamin
                                </label>

                                <select name="jenis_kelamin"
                                    class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50
            focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800">

                                    <option value="">Pilih Jenis Kelamin</option>

                                    <option value="Pria"
                                        {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Pria' ? 'selected' : '' }}>
                                        Pria
                                    </option>

                                    <option value="Wanita"
                                        {{ old('jenis_kelamin', $pasien->jenis_kelamin) == 'Wanita' ? 'selected' : '' }}>
                                        Wanita
                                    </option>

                                </select>

                                @error('jenis_kelamin')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        {{-- Alamat --}}
                        <div class="col-span-2">
                            <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide mb-1.5">
                                Alamat
                            </label>
                            <textarea name="alamat" rows="2"
                                class="w-full px-3.5 py-2.5 text-[13px] border border-slate-200 rounded-[9px] outline-none bg-slate-50 focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)] text-slate-800 resize-none">{{ old('alamat', $pasien->alamat) }}</textarea>
                        </div>

                    </div>
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-4">

                {{-- Info Record --}}
                <div class="bg-white rounded-xl border border-slate-200 p-4">
                    <p class="text-[11px] text-slate-400 uppercase tracking-wide font-medium mb-3">Info Record</p>
                    <div class="space-y-2.5 text-[12px]">
                        <div class="flex justify-between">
                            <span class="text-slate-400">Kode Pasien</span>
                            <span class="font-medium text-slate-700">{{ $pasien->kode_pasien ?? '-' }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">ID</span>
                            <span
                                class="font-medium text-slate-700">#{{ str_pad($pasien->id, 4, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Dibuat</span>
                            <span class="font-medium text-slate-700">{{ $pasien->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-slate-400">Diperbarui</span>
                            <span class="font-medium text-slate-700">{{ $pasien->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Panduan --}}
                <div class="bg-white rounded-xl border border-slate-200 p-4">
                    <p class="font-bold text-[13px] text-slate-800 mb-3" style="font-family:'Syne',sans-serif;">Panduan
                        Pengisian</p>
                    <div class="space-y-2.5 text-[12px] text-slate-500 leading-relaxed">
                        <p>• Field bertanda <span class="text-red-400 font-medium">*</span> wajib diisi</p>
                        <p>• Email harus unik dan valid</p>
                        <p>• Password minimal 6 karakter</p>
                        <p>• Kosongkan password jika tidak ingin mengubahnya</p>
                    </div>
                </div>

                {{-- Actions --}}
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
                    <a href="{{ route('pasien.index') }}"
                        class="w-full flex items-center justify-center text-[13px] font-medium text-slate-500 border border-slate-200 py-2.5 rounded-[9px] hover:bg-slate-50 transition">
                        Batal
                    </a>
                </div>

            </div>
        </div>
    </form>

@endsection
