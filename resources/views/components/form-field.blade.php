@props(['label', 'for', 'error' => false])

<div>
    <x-input-label :for="$for" :value="$label" />
    {{ $slot }}
    @if($error)
        <x-input-error :messages="$error" class="mt-1" />
    @endif
</div>
