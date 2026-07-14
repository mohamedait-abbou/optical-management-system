@props(['variant' => 'default'])

@php
$classes = match($variant) {
    'success' => 'bg-emerald-50 text-emerald-700 border-emerald-100',
    'danger' => 'bg-rose-50 text-rose-700 border-rose-100',
    'warning' => 'bg-amber-50 text-amber-700 border-amber-100',
    'info' => 'bg-slate-50 text-slate-700 border-slate-200',
    default => 'bg-slate-50 text-slate-700 border-slate-200',
};
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold tracking-wide {$classes}"]) }}>
    {{ $slot }}
</span>
