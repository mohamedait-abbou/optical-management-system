@extends('layouts.crm')

@section('page-title', 'Paramètres')

@section('content')

<div class="space-y-8">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Paramètres</h1>
            <p class="mt-1 text-slate-500">Configurez les préférences de votre magasin</p>
        </div>
        <button form="settings-form" type="submit" 
            class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-2xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-600/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
            Enregistrer les modifications
        </button>
    </div>

    <form id="settings-form" action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div class="grid lg:grid-cols-3 gap-6">
            
            <!-- Left Sidebar - Navigation -->
            <div class="space-y-4">
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-4">
                    <nav class="space-y-1">
                        <button type="button" onclick="showTab('store')" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-indigo-600 bg-indigo-50 transition-all" data-tab="store">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                            Informations magasin
                        </button>
                        <button type="button" onclick="showTab('hours')" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-all" data-tab="hours">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Horaires d'ouverture
                        </button>
                        <button type="button" onclick="showTab('notifications')" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-all" data-tab="notifications">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                            Notifications
                        </button>
                        <button type="button" onclick="showTab('stock')" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-all" data-tab="stock">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                            Stock & Alertes
                        </button>
                        <button type="button" onclick="showTab('billing')" class="tab-btn w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-50 transition-all" data-tab="billing">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                            Facturation & Taxes
                        </button>
                    </nav>
                </div>
            </div>

            <!-- Right Content - Forms -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Tab: Store Information -->
                <div id="tab-store" class="tab-content bg-white rounded-3xl shadow-sm border border-slate-100 p-8">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 rounded-xl bg-indigo-50 text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Informations du Magasin</h2>
                            <p class="text-sm text-slate-500">Détails de votre établissement</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Logo Upload -->
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3">Logo du Magasin</label>
                            <div class="flex items-center gap-6">
                                <div class="w-24 h-24 rounded-2xl bg-slate-100 border-2 border-dashed border-slate-300 flex items-center justify-center overflow-hidden">
                                    @if($settings['store_logo'])
                                        <img src="{{ Storage::url($settings['store_logo']) }}" alt="Logo" class="w-full h-full object-cover">
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                                    @endif
                                </div>
                                <div>
                                    <input type="file" name="logo" accept="image/*" class="hidden" id="logo-input">
                                    <button type="button" onclick="document.getElementById('logo-input').click()" 
                                        class="px-4 py-2 bg-slate-100 text-slate-700 font-semibold rounded-xl hover:bg-slate-200 transition">
                                        Changer le logo
                                    </button>
                                    <p class="mt-2 text-xs text-slate-500">PNG, JPG jusqu'à 2MB</p>
                                </div>
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nom du Magasin *</label>
                                <input type="text" name="store_name" value="{{ $settings['store_name'] }}" 
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" required>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Email *</label>
                                <input type="email" name="store_email" value="{{ $settings['store_email'] }}" 
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" required>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Téléphone</label>
                            <input type="text" name="store_phone" value="{{ $settings['store_phone'] }}" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Adresse</label>
                            <textarea name="store_address" rows="3" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">{{ $settings['store_address'] }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Tab: Opening Hours -->
                <div id="tab-hours" class="tab-content bg-white rounded-3xl shadow-sm border border-slate-100 p-8 hidden">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 rounded-xl bg-emerald-50 text-emerald-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Horaires d'Ouverture</h2>
                            <p class="text-sm text-slate-500">Définissez vos heures d'ouverture</p>
                        </div>
                    </div>

                    <div class="space-y-4" id="opening-hours-container">
                        @php
                            $days = [
                                'monday' => 'Lundi',
                                'tuesday' => 'Mardi',
                                'wednesday' => 'Mercredi',
                                'thursday' => 'Jeudi',
                                'friday' => 'Vendredi',
                                'saturday' => 'Samedi',
                                'sunday' => 'Dimanche'
                            ];
                            $hours = json_decode($settings['opening_hours'], true);
                        @endphp

                        @foreach($days as $dayKey => $dayName)
                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-slate-50 border border-slate-100">
                                <div class="w-32">
                                    <span class="font-semibold text-slate-700">{{ $dayName }}</span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <input type="time" name="opening_hours[{{ $dayKey }}][start]" 
                                        value="{{ $hours[$dayKey]['start'] ?? '09:00' }}"
                                        class="px-3 py-2 rounded-lg border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                                    <span class="text-slate-400">-</span>
                                    <input type="time" name="opening_hours[{{ $dayKey }}][end]" 
                                        value="{{ $hours[$dayKey]['end'] ?? '18:00' }}"
                                        class="px-3 py-2 rounded-lg border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                                </div>
                                <label class="flex items-center gap-2 ml-auto cursor-pointer">
                                    <input type="checkbox" name="opening_hours[{{ $dayKey }}][open]" 
                                        value="1" {{ ($hours[$dayKey]['open'] ?? true) ? 'checked' : '' }}
                                        class="w-5 h-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-sm font-medium text-slate-600">Ouvert</span>
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Tab: Notifications -->
                <div id="tab-notifications" class="tab-content bg-white rounded-3xl shadow-sm border border-slate-100 p-8 hidden">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 rounded-xl bg-amber-50 text-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Notifications</h2>
                            <p class="text-sm text-slate-500">Configurez les rappels et alertes</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                            <h3 class="font-semibold text-slate-900 mb-4">Rappels de Rendez-vous</h3>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Heures avant le RDV</label>
                                <select name="appointment_reminder_hours" 
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                                    <option value="1" {{ $settings['appointment_reminder_hours'] == '1' ? 'selected' : '' }}>1 heure</option>
                                    <option value="2" {{ $settings['appointment_reminder_hours'] == '2' ? 'selected' : '' }}>2 heures</option>
                                    <option value="24" {{ $settings['appointment_reminder_hours'] == '24' ? 'selected' : '' }}>24 heures</option>
                                    <option value="48" {{ $settings['appointment_reminder_hours'] == '48' ? 'selected' : '' }}>48 heures</option>
                                </select>
                            </div>

                            <div class="flex items-center justify-between p-4 rounded-xl bg-white border border-slate-200">
                                <div>
                                    <p class="font-semibold text-slate-900">Notifications Email</p>
                                    <p class="text-sm text-slate-500">Envoyer des rappels par email</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="enable_email_notifications" value="0">
                                    <input type="checkbox" name="enable_email_notifications" value="1" 
                                        {{ $settings['enable_email_notifications'] ? 'checked' : '' }}
                                        class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>

                            <div class="flex items-center justify-between p-4 rounded-xl bg-white border border-slate-200 mt-3">
                                <div>
                                    <p class="font-semibold text-slate-900">Notifications SMS</p>
                                    <p class="text-sm text-slate-500">Envoyer des rappels par SMS</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="hidden" name="enable_sms_notifications" value="0">
                                    <input type="checkbox" name="enable_sms_notifications" value="1" 
                                        {{ $settings['enable_sms_notifications'] ? 'checked' : '' }}
                                        class="sr-only peer">
                                    <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tab: Stock -->
                <div id="tab-stock" class="tab-content bg-white rounded-3xl shadow-sm border border-slate-100 p-8 hidden">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 rounded-xl bg-cyan-50 text-cyan-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Stock & Alertes</h2>
                            <p class="text-sm text-slate-500">Gérez les seuils d'alerte</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Seuil d'alerte stock faible</label>
                        <div class="flex items-center gap-4">
                            <input type="number" name="low_stock_threshold" value="{{ $settings['low_stock_threshold'] }}" min="1"
                                class="w-32 px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                            <span class="text-slate-500">produits</span>
                        </div>
                        <p class="mt-2 text-sm text-slate-500">Vous recevrez une alerte quand le stock sera inférieur à ce nombre</p>
                    </div>
                </div>

                <!-- Tab: Billing -->
                <div id="tab-billing" class="tab-content bg-white rounded-3xl shadow-sm border border-slate-100 p-8 hidden">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="p-2 rounded-xl bg-rose-50 text-rose-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-900">Facturation & Taxes</h2>
                            <p class="text-sm text-slate-500">Configuration fiscale</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Taux de TVA (%)</label>
                            <input type="number" name="tax_rate" value="{{ $settings['tax_rate'] }}" min="0" max="100" step="0.01"
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Devise</label>
                            <select name="currency" 
                                class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
                                <option value="MAD" {{ $settings['currency'] == 'MAD' ? 'selected' : '' }}>MAD - Dirham Marocain</option>
                                <option value="EUR" {{ $settings['currency'] == 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                                <option value="USD" {{ $settings['currency'] == 'USD' ? 'selected' : '' }}>USD - Dollar US</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

</div>

<script>
    function showTab(tabName) {
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Show selected tab
        document.getElementById('tab-' + tabName).classList.remove('hidden');
        
        // Update button styles
        document.querySelectorAll('.tab-btn').forEach(btn => {
            if(btn.dataset.tab === tabName) {
                btn.classList.remove('text-slate-600', 'hover:bg-slate-50');
                btn.classList.add('text-indigo-600', 'bg-indigo-50');
            } else {
                btn.classList.add('text-slate-600', 'hover:bg-slate-50');
                btn.classList.remove('text-indigo-600', 'bg-indigo-50');
            }
        });
    }
</script>

@endsection