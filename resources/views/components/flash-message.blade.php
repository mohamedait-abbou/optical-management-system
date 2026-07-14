@props(['type' => 'success', 'message'])

@php
$classes = $type === 'error'
    ? 'border-rose-200 bg-rose-50 text-rose-700'
    : 'border-emerald-200 bg-emerald-50 text-emerald-700';
@endphp

<div {{ $attributes->merge(['class' => "rounded-3xl border px-4 py-4 shadow-sm {$classes}"]) }}>
    <p class="text-sm font-medium">{{ $message }}</p>
</div>
