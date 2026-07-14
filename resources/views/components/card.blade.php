@props(['class' => ''])

<div {{ $attributes->merge(['class' => 'rounded-[28px] border border-slate-200 bg-white shadow-sm ' . $class]) }}>
    {{ $slot }}
</div>
