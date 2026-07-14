@php
    $brand = $brand ?? null;
@endphp

<div class="grid gap-6 lg:grid-cols-2">

    <div class="space-y-4">

        <div>
            <x-input-label for="name" value="Brand Name" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-2 w-full"
                value="{{ old('name', $brand->name ?? '') }}"
            />

            <x-input-error :messages="$errors->get('name')" class="mt-1"/>
        </div>

        <div>
            <x-input-label for="country" value="Country" />

            <x-text-input
                id="country"
                name="country"
                type="text"
                class="mt-2 w-full"
                value="{{ old('country', $brand->country ?? '') }}"
            />

            <x-input-error :messages="$errors->get('country')" class="mt-1"/>
        </div>

    </div>

    <div class="space-y-4">

        <div>
            <x-input-label for="logo" value="Logo URL" />

            <x-text-input
                id="logo"
                name="logo"
                type="text"
                class="mt-2 w-full"
                value="{{ old('logo', $brand->logo ?? '') }}"
            />

            <x-input-error :messages="$errors->get('logo')" class="mt-1"/>
        </div>

        <div>
            <x-input-label for="description" value="Description" />

            <textarea
                id="description"
                name="description"
                rows="5"
                class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3"
            >{{ old('description', $brand->description ?? '') }}</textarea>

            <x-input-error :messages="$errors->get('description')" class="mt-1"/>
        </div>

    </div>

</div>