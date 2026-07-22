@extends('layouts.crm')

@section('page-title', 'Rapports et Analyses')

@section('content')
<div class="space-y-8">
    <!-- Premium Header with Actions -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Business Intelligence</p>
            <h1 class="text-3xl font-bold bg-gradient-to-r from-indigo-600 via-fuchsia-600 to-cyan-600 bg-clip-text text-transparent">
                Rapports et Analyses
            </h1>
            <p class="mt-1 text-sm text-slate-500">Tableau de bord analytique complet de votre activité</p>
        </div>
        <button class="inline-flex items-center gap-2 rounded-xl bg-gradient-to-r from-emerald-600 to-teal-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-emerald-500/30 transition hover:scale-[1.02]">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
            Exporter Excel
        </button>
    </div>

    <!-- Date Range Filter -->
    <form method="GET" action="{{ route('reports.index') }}" class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">Date de début</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="rounded-lg border-slate-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-1">Date de fin</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="rounded-lg border-slate-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>
            <button type="submit" class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-indigo-700 transition">
                Appliquer les filtres
            </button>
        </div>
    </form>

    <!-- KPI Cards with Gradients -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 p-6 text-white shadow-xl shadow-emerald-500/20">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
            <div class="relative">
                <p class="text-sm font-medium text-emerald-100">Chiffre d'affaires</p>
                <p class="mt-2 text-3xl font-bold">{{ number_format($financials->total_revenue ?? 0, 2) }} DH</p>
                <p class="mt-2 text-xs text-emerald-100">Sur la période sélectionnée</p>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-500 to-blue-600 p-6 text-white shadow-xl shadow-indigo-500/20">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
            <div class="relative">
                <p class="text-sm font-medium text-indigo-100">Marge Bénéficiaire</p>
                <p class="mt-2 text-3xl font-bold">{{ number_format($estimatedProfit, 2) }} DH</p>
                <p class="mt-2 text-xs text-indigo-100">~40% du CA estimé</p>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-fuchsia-500 to-pink-600 p-6 text-white shadow-xl shadow-fuchsia-500/20">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
            <div class="relative">
                <p class="text-sm font-medium text-fuchsia-100">Commandes</p>
                <p class="mt-2 text-3xl font-bold">{{ $financials->total_orders ?? 0 }}</p>
                <p class="mt-2 text-xs text-fuchsia-100">Total période</p>
            </div>
        </div>

        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 p-6 text-white shadow-xl shadow-amber-500/20">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
            <div class="relative">
                <p class="text-sm font-medium text-amber-100">Panier Moyen</p>
                <p class="mt-2 text-3xl font-bold">{{ number_format($financials->avg_order_value ?? 0, 2) }} DH</p>
                <p class="mt-2 text-xs text-amber-100">Par commande</p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Revenue Trend Chart -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-lg lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Évolution du Chiffre d'Affaires</h3>
                    <p class="text-sm text-slate-500">Performance sur les 6 derniers mois</p>
                </div>
                <div class="flex gap-2">
                    <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700">+18% vs période précédente</span>
                </div>
            </div>
            <div class="relative h-72">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Employee Performance Chart -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-lg">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Performance par Employé</h3>
            <div class="relative h-64">
                <canvas id="employeeChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Detailed Tables Section -->
    <div class="grid gap-6 lg:grid-cols-2">
        
        <!-- Employee Performance Table -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-900">Top Employés (Par CA généré)</h3>
                <a href="#" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Voir tout →</a>
            </div>
            <div class="space-y-3">
                @forelse($employeePerformance as $index => $emp)
                <div class="flex items-center justify-between rounded-xl border border-slate-100 bg-slate-50/50 p-4 hover:bg-slate-100 transition">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gradient-to-br from-indigo-500 to-fuchsia-500 text-white font-bold">
                            {{ $index + 1 }}
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">{{ $emp->name }}</p>
                            <p class="text-xs text-slate-500">{{ $emp->total_sales }} ventes</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-emerald-600">{{ number_format($emp->total_revenue, 2) }} DH</p>
                    </div>
                </div>
                @empty
                <p class="text-center text-slate-500 py-8">Aucune donnée disponible</p>
                @endforelse
            </div>
        </div>

        <!-- Dead Stock Alert -->
        <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-lg">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-bold text-slate-900">️ Stock Dormant (>90 jours)</h3>
                <span class="rounded-full bg-rose-50 px-3 py-1 text-xs font-semibold text-rose-700">{{ $deadStock->count() }} produits</span>
            </div>
            <div class="space-y-3">
                @forelse($deadStock as $item)
                <div class="flex items-center justify-between rounded-xl border border-rose-100 bg-rose-50/30 p-4 hover:bg-rose-50 transition">
                    <div class="flex items-center gap-4">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-100 text-rose-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-900">{{ $item->name }}</p>
                            <p class="text-xs text-slate-500">{{ $item->quantity }} unités en stock</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-rose-600">{{ number_format($item->quantity * $item->price, 2) }} DH</p>
                        <p class="text-xs text-rose-500">Capital bloqué</p>
                    </div>
                </div>
                @empty
                <div class="rounded-xl border border-emerald-200 bg-emerald-50/50 p-6 text-center">
                    <svg class="mx-auto h-12 w-12 text-emerald-500 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    <p class="text-sm font-semibold text-emerald-800">Excellent !</p>
                    <p class="text-xs text-emerald-600 mt-1">Aucun stock dormant détecté</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Performance Metrics with Progress Bars -->
    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-lg">
        <h3 class="text-lg font-bold text-slate-900 mb-6">Indicateurs de Performance Clés</h3>
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                <p class="text-sm text-slate-500">Taux de conversion</p>
                <p class="mt-2 text-2xl font-bold text-slate-900">68%</p>
                <div class="mt-3 h-2.5 rounded-full bg-slate-200">
                    <div class="h-2.5 rounded-full bg-gradient-to-r from-indigo-500 to-fuchsia-500" style="width: 68%"></div>
                </div>
            </div>
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                <p class="text-sm text-slate-500">Satisfaction client</p>
                <p class="mt-2 text-2xl font-bold text-slate-900">4.8/5</p>
                <div class="mt-3 h-2.5 rounded-full bg-slate-200">
                    <div class="h-2.5 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500" style="width: 96%"></div>
                </div>
            </div>
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                <p class="text-sm text-slate-500">Taux de fidélisation</p>
                <p class="mt-2 text-2xl font-bold text-slate-900">72%</p>
                <div class="mt-3 h-2.5 rounded-full bg-slate-200">
                    <div class="h-2.5 rounded-full bg-gradient-to-r from-fuchsia-500 to-pink-500" style="width: 72%"></div>
                </div>
            </div>
            <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">
                <p class="text-sm text-slate-500">Rotation du stock</p>
                <p class="mt-2 text-2xl font-bold text-slate-900">4.2x/an</p>
                <div class="mt-3 h-2.5 rounded-full bg-slate-200">
                    <div class="h-2.5 rounded-full bg-gradient-to-r from-amber-500 to-orange-500" style="width: 65%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Revenue Chart (Line)
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const gradient = revenueCtx.createLinearGradient(0, 0, 0, 300);
    gradient.addColorStop(0, 'rgba(99, 102, 241, 0.3)');
    gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');

    // Sample data - replace with real data from controller
    const revenueData = {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'],
        datasets: [{
            label: 'Chiffre d\'affaires (DH)',
            data: [12000, 19000, 15000, 25000, 22000, 30000],
            borderColor: '#6366f1',
            backgroundColor: gradient,
            borderWidth: 3,
            tension: 0.4,
            fill: true,
            pointRadius: 6,
            pointBackgroundColor: '#ffffff',
            pointBorderColor: '#6366f1',
            pointBorderWidth: 2,
            pointHoverRadius: 8,
        }]
    };

    new Chart(revenueCtx, {
        type: 'line',
        data: revenueData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#0f172a',
                    padding: 16,
                    cornerRadius: 12,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y.toLocaleString('fr-FR') + ' DH';
                        }
                    }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#64748b' } },
                y: { 
                    grid: { color: '#f1f5f9' }, 
                    ticks: { 
                        color: '#64748b',
                        callback: function(value) { return value / 1000 + 'k'; }
                    } 
                }
            }
        }
    });

    // Employee Performance Chart (Bar)
    const employeeCtx = document.getElementById('employeeChart').getContext('2d');
    const employeeData = @json($employeePerformance);
    
    new Chart(employeeCtx, {
        type: 'bar',
        data: {
            labels: employeeData.map(emp => emp.name.split(' ')[0]),
            datasets: [{
                label: 'CA Généré (DH)',
                data: employeeData.map(emp => emp.total_revenue),
                backgroundColor: [
                    '#6366f1',
                    '#06b6d4',
                    '#f59e0b',
                    '#ec4899',
                    '#8b5cf6'
                ],
                borderRadius: 8,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                x: { grid: { display: false }, ticks: { color: '#64748b' } },
                y: { 
                    grid: { color: '#f1f5f9' }, 
                    ticks: { 
                        color: '#64748b',
                        callback: function(value) { return value / 1000 + 'k'; }
                    } 
                }
            }
        }
    });
</script>
@endsection