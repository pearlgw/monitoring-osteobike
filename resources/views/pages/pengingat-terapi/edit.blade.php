@extends('layouts.app')

@section('title', 'Edit Pengingat Terapi')

@section('content')

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('pengingat-terapi.index') }}"
            class="w-8 h-8 flex items-center justify-center rounded-lg border border-slate-200 text-slate-500 hover:bg-slate-50 transition">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                <polyline points="15 18 9 12 15 6" />
            </svg>
        </a>
        <div>
            <h1 class="font-black text-xl text-slate-900" style="font-family:'Syne',sans-serif;">Edit Pengingat</h1>
            <p class="text-xs text-slate-400 mt-0.5">Perbarui jadwal pengingat terapi</p>
        </div>
    </div>

    <div class="max-w-lg">
        <div class="bg-white rounded-xl border border-slate-200 overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100">
                <p class="text-[13px] font-semibold text-slate-700">Informasi Pengingat</p>
            </div>

            <form method="POST" action="{{ route('pengingat-terapi.update', $pengingatTerapi->id) }}"
                class="p-5 space-y-4">
                @csrf
                @method('PUT')

                {{-- Pasien --}}
                <div>
                    <label class="block text-[12px] font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">
                        Pasien <span class="text-red-400">*</span>
                    </label>
                    <select name="user_id"
                        class="w-full py-2.5 pl-3 pr-4 text-[13px] border rounded-lg outline-none bg-slate-50
                                   focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)]
                                   text-slate-700 @error('user_id') border-red-300 bg-red-50 @else border-slate-200 @enderror">
                        <option value="">-- Pilih Pasien --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                {{ old('user_id', $pengingatTerapi->user_id) == $user->id ? 'selected' : '' }}>
                                {{ $user->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <label class="block text-[12px] font-semibold text-slate-600 mb-1.5 uppercase tracking-wide">
                        Tanggal Terapi Selanjutnya <span class="text-red-400">*</span>
                    </label>
                    <input type="datetime-local" name="tanggal_terapi_selanjutnya"
                        value="{{ old('tanggal_terapi_selanjutnya', $pengingatTerapi->tanggal_terapi_selanjutnya->format('Y-m-d\TH:i')) }}"
                        class="w-full py-2.5 px-3 text-[13px] border rounded-lg outline-none bg-slate-50
                                  focus:bg-white focus:border-[#0EA5A4] focus:ring-2 focus:ring-[rgba(14,165,164,0.1)]
                                  text-slate-700 @error('tanggal_terapi_selanjutnya') border-red-300 bg-red-50 @else border-slate-200 @enderror">
                    @error('tanggal_terapi_selanjutnya')
                        <p class="mt-1 text-[11px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
                    <a href="{{ route('pengingat-terapi.index') }}"
                        class="text-[13px] font-medium text-slate-500 px-4 py-2 rounded-lg border border-slate-200 hover:bg-slate-50 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center gap-2 bg-[#3B82F6] hover:bg-blue-600 text-white text-[13px] font-medium px-5 py-2 rounded-lg transition">
                        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                        </svg>
                        Update
                    </button>
                </div>
            </form>

        </div>
    </div>

@endsection
