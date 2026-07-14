<x-modal name="quick-add-customer">
    <div x-data="quickAddCustomer()"
         x-on:open-modal.window="if ($event.detail === 'quick-add-customer') { reset(); errors = {}; serverError = ''; }"
         class="p-6">
        <div class="flex items-start justify-between gap-4 mb-6">
            <div>
                <h2 class="text-xl font-semibold text-slate-900">Ajouter un client</h2>
                <p class="mt-1 text-sm text-slate-500">Créez un client et sélectionnez-le automatiquement dans votre formulaire.</p>
            </div>
            <button type="button"
                    class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition hover:bg-slate-200"
                    @click="$dispatch('close-modal', 'quick-add-customer')">
                <span class="sr-only">Fermer</span>
                ×
            </button>
        </div>

        <template x-if="serverError">
            <div class="rounded-3xl border border-rose-200 bg-rose-50 p-4 text-sm text-rose-700 mb-4" x-text="serverError"></div>
        </template>

        <form id="quick-add-customer-form" @submit.prevent="submit" class="space-y-6">
            @csrf

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="space-y-4">
                    <div>
                        <x-input-label for="quick_first_name" value="Prénom" />
                        <x-text-input id="quick_first_name" name="first_name" type="text" x-model="form.first_name" class="mt-2 w-full" />
                        <p x-show="errors.first_name" class="mt-2 text-sm text-rose-600" x-text="errors.first_name ? errors.first_name[0] : ''"></p>
                    </div>

                    <div>
                        <x-input-label for="quick_last_name" value="Nom" />
                        <x-text-input id="quick_last_name" name="last_name" type="text" x-model="form.last_name" class="mt-2 w-full" />
                        <p x-show="errors.last_name" class="mt-2 text-sm text-rose-600" x-text="errors.last_name ? errors.last_name[0] : ''"></p>
                    </div>

                    <div>
                        <x-input-label for="quick_cin" value="CIN" />
                        <x-text-input id="quick_cin" name="cin" type="text" x-model="form.cin" class="mt-2 w-full" />
                        <p x-show="errors.cin" class="mt-2 text-sm text-rose-600" x-text="errors.cin ? errors.cin[0] : ''"></p>
                    </div>

                    <div>
                        <x-input-label for="quick_phone" value="Téléphone" />
                        <x-text-input id="quick_phone" name="phone" type="tel" x-model="form.phone" class="mt-2 w-full" />
                        <p x-show="errors.phone" class="mt-2 text-sm text-rose-600" x-text="errors.phone ? errors.phone[0] : ''"></p>
                    </div>

                    <div>
                        <x-input-label for="quick_email" value="Email" />
                        <x-text-input id="quick_email" name="email" type="email" x-model="form.email" class="mt-2 w-full" />
                        <p x-show="errors.email" class="mt-2 text-sm text-rose-600" x-text="errors.email ? errors.email[0] : ''"></p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div>
                        <x-input-label for="quick_address" value="Adresse" />
                        <textarea id="quick_address" name="address" x-model="form.address" rows="4" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:ring-brand-500/20"></textarea>
                        <p x-show="errors.address" class="mt-2 text-sm text-rose-600" x-text="errors.address ? errors.address[0] : ''"></p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <x-input-label for="quick_birth_date" value="Date de naissance" />
                            <x-text-input id="quick_birth_date" name="birth_date" type="date" x-model="form.birth_date" class="mt-2 w-full" />
                            <p x-show="errors.birth_date" class="mt-2 text-sm text-rose-600" x-text="errors.birth_date ? errors.birth_date[0] : ''"></p>
                        </div>
                        <div>
                            <x-input-label for="quick_gender" value="Genre" />
                            <select id="quick_gender" name="gender" x-model="form.gender" class="mt-2 w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:ring-brand-500/20">
                                <option value="">Sélectionnez</option>
                                <option value="Male">Masculin</option>
                                <option value="Female">Féminin</option>
                            </select>
                            <p x-show="errors.gender" class="mt-2 text-sm text-rose-600" x-text="errors.gender ? errors.gender[0] : ''"></p>
                        </div>
                    </div>

                    <div>
                        <x-input-label for="quick_notes" value="Notes" />
                        <textarea id="quick_notes" name="notes" x-model="form.notes" rows="4" class="mt-2 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-brand-500 focus:ring-brand-500/20"></textarea>
                        <p x-show="errors.notes" class="mt-2 text-sm text-rose-600" x-text="errors.notes ? errors.notes[0] : ''"></p>
                    </div>
                </div>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">
                <button type="button" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                        @click="$dispatch('close-modal', 'quick-add-customer')">Annuler</button>
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700"
                        :disabled="submitting">
                    <span x-show="!submitting">Enregistrer</span>
                    <span x-show="submitting">Enregistrement...</span>
                </button>
            </div>
        </form>
    </div>

    <script>
        function quickAddCustomer() {
            return {
                form: {
                    first_name: '',
                    last_name: '',
                    cin: '',
                    phone: '',
                    email: '',
                    address: '',
                    birth_date: '',
                    gender: '',
                    notes: '',
                },
                errors: {},
                serverError: '',
                submitting: false,
                reset() {
                    this.form.first_name = '';
                    this.form.last_name = '';
                    this.form.cin = '';
                    this.form.phone = '';
                    this.form.email = '';
                    this.form.address = '';
                    this.form.birth_date = '';
                    this.form.gender = '';
                    this.form.notes = '';
                    this.errors = {};
                    this.serverError = '';
                },
                async submit() {
                    this.errors = {};
                    this.serverError = '';
                    this.submitting = true;

                    const data = new FormData();
                    Object.entries(this.form).forEach(([key, value]) => data.append(key, value));
                    data.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));

                    try {
                        const response = await fetch("{{ route('customers.store') }}", {
                            method: 'POST',
                            headers: {
                                'Accept': 'application/json',
                            },
                            body: data,
                        });

                        if (response.status === 422) {
                            const payload = await response.json();
                            this.errors = payload.errors || {};
                            return;
                        }

                        if (!response.ok) {
                            this.serverError = 'Impossible d\'enregistrer le client pour le moment. Réessayez plus tard.';
                            return;
                        }

                        const payload = await response.json();
                        const customer = payload.customer;

                        document.querySelectorAll('select[name="customer_id"]').forEach(select => {
                            if (!select.querySelector(`option[value="${customer.id}"]`)) {
                                const option = document.createElement('option');
                                option.value = customer.id;
                                option.textContent = `${customer.first_name} ${customer.last_name}${customer.cin ? ` (${customer.cin})` : ''}`;
                                select.append(option);
                            }
                            select.value = customer.id;
                        });

                        this.reset();
                        window.dispatchEvent(new CustomEvent('close-modal', { detail: 'quick-add-customer' }));
                    } catch (error) {
                        this.serverError = 'Une erreur est survenue. Vérifiez votre connexion et réessayez.';
                    } finally {
                        this.submitting = false;
                    }
                },
            };
        }
    </script>
</x-modal>
