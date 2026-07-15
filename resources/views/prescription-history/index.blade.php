@extends('layouts.crm')

@section('page-title', 'Historique Visuel - ' . ($customer->first_name . ' ' . $customer->last_name))

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('customers.show', $customer) }}" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M19 12H5M12 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Historique Visuel</p>
                <h2 class="text-2xl font-semibold text-slate-900">{{ $customer->first_name }} {{ $customer->last_name }}</h2>
            </div>
        </div>
        <a href="{{ route('prescription-history.create', $customer) }}" 
           class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700 shadow-lg shadow-indigo-600/20">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Nouvelle Prescription
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($prescriptions->count() > 0)
        <!-- Evolution Chart (CORRIGÉ : Hauteur fixe pour empêcher le débordement) -->
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                Évolution de la Vue (Sphère)
            </h2>
            
            <!-- CONTENEUR AVEC HAUTEUR FIXE (C'est ça qui bloque la taille) -->
            <div class="relative w-full" style="height: 300px;">
                <canvas id="evolutionChart"></canvas>
            </div>
        </div>
    @endif

    <!-- Prescriptions List -->
    @if($prescriptions->isEmpty())
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm">
            <div class="mx-auto flex max-w-xl flex-col items-center gap-4 text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75">
                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/>
                    <circle cx="12" cy="12" r="3"/>
                </svg>
                <div>
                    <h3 class="text-xl font-semibold text-slate-900">Aucun historique visuel</h3>
                    <p class="mt-2 text-sm text-slate-500">Ajoutez une première prescription pour ce patient.</p>
                </div>
            </div>
        </div>
    @else
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full text-left text-sm text-slate-700">
                <thead class="border-b bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">OD (Sphère / Cyl / Axe)</th>
                        <th class="px-6 py-4">OG (Sphère / Cyl / Axe)</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($prescriptions as $prescription)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-medium">{{ $prescription->examination_date->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                {{ $prescription->formatValue($prescription->od_sphere) }} / 
                                {{ $prescription->formatValue($prescription->od_cylinder) }} / 
                                {{ $prescription->od_axis ?? '-' }}°
                            </td>
                            <td class="px-6 py-4">
                                {{ $prescription->formatValue($prescription->og_sphere) }} / 
                                {{ $prescription->formatValue($prescription->og_cylinder) }} / 
                                {{ $prescription->og_axis ?? '-' }}°
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($prescription->vision_type == 'distance') bg-blue-50 text-blue-700
                                    @elseif($prescription->vision_type == 'near') bg-amber-50 text-amber-700
                                    @else bg-purple-50 text-purple-700 @endif">
                                    {{ ucfirst($prescription->vision_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('prescription-history.edit', [$customer, $prescription]) }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-sm font-medium text-slate-600 transition hover:bg-slate-100">Modifier</a>
                                    <form action="{{ route('prescription-history.destroy', [$customer, $prescription]) }}" method="POST" class="inline-block" onsubmit="return confirm('Supprimer cette prescription ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-full border border-rose-200 bg-rose-50 px-3 py-1 text-sm font-medium text-rose-700 transition hover:bg-rose-100">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $prescriptions->links() }}
        </div>
    @endif
</div>

@if($prescriptions->count() > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    fetch("{{ route('prescription-history.api.evolution', $customer) }}")
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('evolutionChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.dates,
                    datasets: [
                        {
                            label: 'OD Sphère',
                            data: data.od_sphere,
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'OG Sphère',
                            data: data.og_sphere,
                            borderColor: '#8b5cf6',
                            backgroundColor: 'rgba(139, 92, 246, 0.1)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // <-- EMPÊCHE LE GRAPHIQUE DE DÉPASSER
                    plugins: {
                        legend: { display: true, position: 'top' }
                    },
                    scales: {
                        y: {
                            reverse: true,
                            grid: { color: 'rgba(0,0,0,0.05)' }
                        },
                        x: { grid: { display: false } }
                    }
                }
            });
        });
</script>
@endif
@endsection