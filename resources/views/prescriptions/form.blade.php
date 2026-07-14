@php
    $prescription = $prescription ?? null;
@endphp

<div class="grid gap-6">

    <div class="grid gap-4 sm:grid-cols-2">

        <div>
            <x-input-label for="doctor_name" value="Médecin" />
            <x-text-input
                id="doctor_name"
                name="doctor_name"
                type="text"
                class="mt-1 block w-full"
                value="{{ old('doctor_name', optional($prescription)->doctor_name) }}"
            />
            <x-input-error :messages="$errors->get('doctor_name')" class="mt-2"/>
        </div>

        <div>
            <x-input-label for="prescription_date" value="Date de l'ordonnance" />
            <x-text-input
                id="prescription_date"
                name="prescription_date"
                type="date"
                class="mt-1 block w-full"
                value="{{ old('prescription_date', optional($prescription)->prescription_date) }}"
            />
            <x-input-error :messages="$errors->get('prescription_date')" class="mt-2"/>
        </div>

    </div>

    <div class="grid gap-4 sm:grid-cols-2">

        <div>
            <div class="flex items-center justify-between gap-3">
                <x-input-label for="customer_id" value="Patient" />
                <button type="button"
                        class="rounded-full border border-slate-300 bg-white px-3 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50"
                        @click="$dispatch('open-modal', 'quick-add-customer')">
                    + Nouveau patient
                </button>
            </div>

            <select
                id="customer_id"
                name="customer_id"
                class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-3"
            >

                <option value="">Sélectionnez un patient</option>

                @foreach($customers as $customer)

                    <option
                        value="{{ $customer->id }}"
                        {{ old('customer_id', optional($prescription)->customer_id) == $customer->id ? 'selected' : '' }}
                    >
                        {{ $customer->first_name }} {{ $customer->last_name }}@if($customer->cin) ({{ $customer->cin }})@endif
                    </option>

                @endforeach

            </select>

            <x-input-error :messages="$errors->get('customer_id')" class="mt-2"/>

        </div>

        <div>
            <x-input-label for="notes" value="Notes" />

            <textarea
                id="notes"
                name="notes"
                rows="4"
                class="mt-1 block w-full rounded-xl border border-slate-300 px-4 py-3"
            >{{ old('notes', optional($prescription)->notes) }}</textarea>

            <x-input-error :messages="$errors->get('notes')" class="mt-2"/>
        </div>

    </div>

    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6">

        <div class="grid gap-8 lg:grid-cols-2">

            <div>

                <h3 class="mb-4 text-lg font-bold">
                    Œil Droit (OD)
                </h3>

                <div class="space-y-4">

                    <div>
                        <x-input-label for="right_sphere" value="Sphere"/>
                        <x-text-input
                            id="right_sphere"
                            name="right_sphere"
                            class="mt-1 block w-full"
                            value="{{ old('right_sphere', optional($prescription)->right_sphere) }}"
                        />
                    </div>

                    <div>
                        <x-input-label for="right_cylinder" value="Cylindre"/>
                        <x-text-input
                            id="right_cylinder"
                            name="right_cylinder"
                            class="mt-1 block w-full"
                            value="{{ old('right_cylinder', optional($prescription)->right_cylinder) }}"
                        />
                    </div>

                    <div>
                        <x-input-label for="right_axis" value="Axe"/>
                        <x-text-input
                            id="right_axis"
                            name="right_axis"
                            class="mt-1 block w-full"
                            value="{{ old('right_axis', optional($prescription)->right_axis) }}"
                        />
                    </div>

                </div>

            </div>

            <div>

                <h3 class="mb-4 text-lg font-bold">
                    Œil Gauche (OS)
                </h3>

                <div class="space-y-4">

                    <div>
                        <x-input-label for="left_sphere" value="Sphere"/>
                        <x-text-input
                            id="left_sphere"
                            name="left_sphere"
                            class="mt-1 block w-full"
                            value="{{ old('left_sphere', optional($prescription)->left_sphere) }}"
                        />
                    </div>

                    <div>
                        <x-input-label for="left_cylinder" value="Cylindre"/>
                        <x-text-input
                            id="left_cylinder"
                            name="left_cylinder"
                            class="mt-1 block w-full"
                            value="{{ old('left_cylinder', optional($prescription)->left_cylinder) }}"
                        />
                    </div>

                    <div>
                        <x-input-label for="left_axis" value="Axe"/>
                        <x-text-input
                            id="left_axis"
                            name="left_axis"
                            class="mt-1 block w-full"
                            value="{{ old('left_axis', optional($prescription)->left_axis) }}"
                        />
                    </div>

                </div>

            </div>

        </div>

        <div class="mt-8 grid gap-4 sm:grid-cols-2">

            <div>
                <x-input-label for="pd" value="Distance Pupillaire (PD)"/>
                <x-text-input
                    id="pd"
                    name="pd"
                    class="mt-1 block w-full"
                    value="{{ old('pd', optional($prescription)->pd) }}"
                />
            </div>

            <div>
                <x-input-label for="addition" value="Addition"/>
                <x-text-input
                    id="addition"
                    name="addition"
                    class="mt-1 block w-full"
                    value="{{ old('addition', optional($prescription)->addition) }}"
                />
            </div>

        </div>

    </div>

</div>