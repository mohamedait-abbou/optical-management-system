@php
    $customer = $customer ?? null;
@endphp

<div class="grid gap-6 lg:grid-cols-2">
    <div class="space-y-4">
        <div>
            <x-input-label for="first_name" value="Prénom" />
            <x-text-input id="first_name" name="first_name" type="text" value="{{ old('first_name', optional($customer)->first_name) }}" class="mt-2 w-full" />
            <x-input-error :messages="$errors->get('first_name')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="last_name" value="Nom" />
            <x-text-input id="last_name" name="last_name" type="text" value="{{ old('last_name', optional($customer)->last_name) }}" class="mt-2 w-full" />
            <x-input-error :messages="$errors->get('last_name')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="cin" value="CIN" />
            <x-text-input id="cin" name="cin" type="text" value="{{ old('cin', optional($customer)->cin) }}" class="mt-2 w-full" />
            <x-input-error :messages="$errors->get('cin')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="phone" value="Téléphone" />
            <x-text-input id="phone" name="phone" type="tel" value="{{ old('phone', optional($customer)->phone) }}" class="mt-2 w-full" />
            <x-input-error :messages="$errors->get('phone')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" value="{{ old('email', optional($customer)->email) }}" class="mt-2 w-full" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>
    </div>

    <div class="space-y-4">
        <div>
            <x-input-label for="address" value="Adresse" />
            <textarea id="address" name="address" rows="4" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:ring-brand-500/20">{{ old('address', $customer->address ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('address')" class="mt-1" />
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <x-input-label for="birth_date" value="Date de naissance" />
                <x-text-input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date', $customer->birth_date ?? '') }}" class="mt-2 w-full" />
                <x-input-error :messages="$errors->get('birth_date')" class="mt-1" />
            </div>

            <div>
                <x-input-label for="gender" value="Genre" />
                <select id="gender" name="gender" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:ring-brand-500/20">
                    <option value="">Sélectionnez</option>
                    <option value="Male" {{ old('gender', $customer->gender ?? '') === 'Male' ? 'selected' : '' }}>Masculin</option>
                    <option value="Female" {{ old('gender', $customer->gender ?? '') === 'Female' ? 'selected' : '' }}>Féminin</option>
                </select>
                <x-input-error :messages="$errors->get('gender')" class="mt-1" />
            </div>
        </div>

        <div>
            <x-input-label for="notes" value="Notes" />
            <textarea id="notes" name="notes" rows="5" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:ring-brand-500/20">{{ old('notes', $customer->notes ?? '') }}</textarea>
            <x-input-error :messages="$errors->get('notes')" class="mt-1" />
        </div>
    </div>
</div>