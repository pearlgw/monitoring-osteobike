@php
    $vasValue = old('vas', $value ?? null);
    $vasOptions = [
        ['value' => 0, 'label' => 'Tidak nyeri', 'color' => '#22c55e'],
        ['value' => 1, 'label' => 'Nyeri ringan', 'color' => '#a3e635'],
        ['value' => 2, 'label' => 'Nyeri ringan', 'color' => '#d9f99d'],
        ['value' => 3, 'label' => 'Nyeri ringan', 'color' => '#facc15'],
        ['value' => 4, 'label' => 'Nyeri sedang', 'color' => '#fb923c'],
        ['value' => 5, 'label' => 'Nyeri sedang', 'color' => '#f97316'],
        ['value' => 6, 'label' => 'Nyeri sedang', 'color' => '#ea580c'],
        ['value' => 7, 'label' => 'Nyeri parah', 'color' => '#ef4444'],
        ['value' => 8, 'label' => 'Nyeri parah', 'color' => '#dc2626'],
        ['value' => 9, 'label' => 'Nyeri parah', 'color' => '#b91c1c'],
        ['value' => 10, 'label' => 'Nyeri parah', 'color' => '#7f1d1d'],
    ];
@endphp

<div class="col-span-2">
    <div class="flex items-center justify-between gap-3 mb-1.5">
        <label class="block text-[11px] font-medium text-slate-500 uppercase tracking-wide">
            Tingkat Nyeri Pasien (VAS - Visual Analog Scale) :
            <span data-vas-summary class="font-bold text-slate-700 normal-case"></span>
        </label>
        <button type="button" data-clear-vas
            class="text-[11px] font-medium text-slate-400 hover:text-slate-600 transition">
            Kosongkan
        </button>
    </div>
    <input type="hidden" name="vas" value="">
    <div class="w-full pb-1">
        <div class="flex items-center gap-1.5 w-full">
            @foreach ($vasOptions as $option)
                @php
                    $isSelected = (string) $vasValue === (string) $option['value'];
                    $textColor = $option['value'] >= 7 || $option['value'] === 0 ? 'text-white' : 'text-slate-900';
                @endphp
                <label class="relative cursor-pointer flex-1 min-w-0" title="{{ $option['label'] }}">
                    <input type="radio" name="vas" value="{{ $option['value'] }}"
                        class="peer sr-only" {{ $isSelected ? 'checked' : '' }}>
                    <span
                        class="w-full h-10 rounded-[8px] flex items-center justify-center text-[13px] font-black border border-white/60 shadow-sm transition peer-focus-visible:ring-2 peer-focus-visible:ring-slate-400 peer-checked:ring-2 peer-checked:ring-slate-900 peer-checked:ring-offset-2 {{ $textColor }}"
                        style="background-color: {{ $option['color'] }};">
                        {{ $option['value'] }}
                    </span>
                </label>
            @endforeach
        </div>
    </div>
    <div class="mt-2 grid grid-cols-2 sm:grid-cols-4 gap-x-3 gap-y-1 text-center text-[11px] text-slate-500">
        <span>0 Tidak nyeri</span>
        <span>1-3 Nyeri ringan</span>
        <span>4-6 Nyeri sedang</span>
        <span>7-10 Nyeri parah</span>
    </div>
    @error('vas')
        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

@once
    @push('scripts')
        <script>
            const vasLabels = ['Tidak Nyeri', 'Nyeri Ringan', 'Nyeri Ringan', 'Nyeri Ringan', 'Nyeri Sedang',
                'Nyeri Sedang', 'Nyeri Sedang', 'Nyeri Parah', 'Nyeri Parah', 'Nyeri Parah', 'Nyeri Parah'
            ];

            function updateVasSummary(wrapper) {
                const summary = wrapper.querySelector('[data-vas-summary]');
                const selected = wrapper.querySelector('input[type="radio"][name="vas"]:checked');

                summary.textContent = selected ? `${selected.value} (${vasLabels[Number(selected.value)]})` : '';
            }

            document.querySelectorAll('[data-vas-summary]').forEach(summary => {
                const wrapper = summary.closest('.col-span-2');
                updateVasSummary(wrapper);

                wrapper.querySelectorAll('input[type="radio"][name="vas"]').forEach(input => {
                    input.addEventListener('change', () => updateVasSummary(wrapper));
                });
            });

            document.querySelectorAll('[data-clear-vas]').forEach(button => {
                button.addEventListener('click', () => {
                    const wrapper = button.closest('.col-span-2');
                    wrapper.querySelectorAll('input[type="radio"][name="vas"]').forEach(input => {
                        input.checked = false;
                    });
                    updateVasSummary(wrapper);
                });
            });
        </script>
    @endpush
@endonce
