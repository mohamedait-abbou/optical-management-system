@extends('layouts.crm')

@section('page-title', 'Modifier la Prescription')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm p-8">
        <h1 class="text-2xl font-bold text-slate-900 mb-6">Modifier la Prescription</h1>
        
        <form action="{{ route('prescription-history.update', [$customer, $prescription]) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Date d'examen</label>
                    <input type="date" name="examination_date" required value="{{ old('examination_date', $prescription->examination_date->format('Y-m-d')) }}"
                           class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                </div>

                <div class="p-6 rounded-2xl bg-blue-50 border border-blue-100">
                    <h3 class="text-lg font-bold text-blue-900 mb-4">il Droit (OD)</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Sphère</label>
                            <input type="number" step="0.25" min="-20" max="20" name="od_sphere" value="{{ old('od_sphere', $prescription->od_sphere) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Cylindre</label>
                            <input type="number" step="0.25" min="-10" max="10" name="od_cylinder" value="{{ old('od_cylinder', $prescription->od_cylinder) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Axe (degrés)</label>
                            <input type="number" min="0" max="180" name="od_axis" value="{{ old('od_axis', $prescription->od_axis) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
                    </div>
                </div>

                <div class="p-6 rounded-2xl bg-purple-50 border border-purple-100">
                    <h3 class="text-lg font-bold text-purple-900 mb-4">Œil Gauche (OG)</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Sphère</label>
                            <input type="number" step="0.25" min="-20" max="20" name="og_sphere" value="{{ old('og_sphere', $prescription->og_sphere) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Cylindre</label>
                            <input type="number" step="0.25" min="-10" max="10" name="og_cylinder" value="{{ old('og_cylinder', $prescription->og_cylinder) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Axe (degrés)</label>
                            <input type="number" min="0" max="180" name="og_axis" value="{{ old('og_axis', $prescription->og_axis) }}"
                                   class="w-full px-4 py-2 rounded-lg border border-slate-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Type de vision</label>
                    <select name="vision_type" required class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">
                        <option value="distance" {{ old('vision_type', $prescription->vision_type) == 'distance' ? 'selected' : '' }}>Vision de loin</option>
                        <option value="near" {{ old('vision_type', $prescription->vision_type) == 'near' ? 'selected' : '' }}>Vision de près</option>
                        <option value="progressive" {{ old('vision_type', $prescription->vision_type) == 'progressive' ? 'selected' : '' }}>Progressive</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Notes</label>
                    <textarea name="notes" rows="3" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200">{{ old('notes', $prescription->notes) }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('prescription-history.index', $customer) }}" 
                   class="px-6 py-3 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold transition">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-3 rounded-2xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-600/20 transition">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
