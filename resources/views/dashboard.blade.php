@extends('layouts.crm')

@section('page-title', 'Tableau de bord')

@section('content')
@php
    $stats = [
        'customers' => $customersCount ?? 0,
        'products' => $productsCount ?? 0,
        'brands' => $brandsCount ?? 0,
        'orders' => $ordersCount ?? 0,
        'revenue' => $totalSales ?? 0,
        'prescriptions' => $prescriptionsCount ?? 0,
    ];

    $recentActivity = $recentActivity ?? [];
    $lowStockProducts = $lowStockProducts ?? [];
@endphp

<div class="space-y-8">
    <!-- Stats Grid -->
    <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-3">
        <!-- Clients -->
        <div class="group overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-indigo-950 p-6 text-white shadow-2xl shadow-indigo-900/20 transition duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-300">Clients</p>
                    <p class="mt-3 text-4xl font-semibold">
                        <span data-counter data-target="{{ $stats['customers'] }}">0</span>
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.85" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 00-3-3.87" />
                        <path d="M16 3.13a4 4 0 010 7.75" />
                    </svg>
                </div>
            </div>
            <p class="mt-5 text-sm text-slate-300">Nombre total de clients enregistrés.</p>
        </div>

        <!-- Produits -->
        <div class="group overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-cyan-950 p-6 text-white shadow-2xl shadow-cyan-900/20 transition duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-300">Produits</p>
                    <p class="mt-3 text-4xl font-semibold">
                        <span data-counter data-target="{{ $stats['products'] }}">0</span>
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.85" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 7h16" />
                        <path d="M4 12h16" />
                        <path d="M4 17h16" />
                    </svg>
                </div>
            </div>
            <p class="mt-5 text-sm text-slate-300">Stock total de montures et accessoires.</p>
        </div>

        <!-- Marques -->
        <div class="group overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-950 p-6 text-white shadow-2xl shadow-emerald-900/20 transition duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-300">Marques</p>
                    <p class="mt-3 text-4xl font-semibold">
                        <span data-counter data-target="{{ $stats['brands'] }}">0</span>
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.85" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 3h18v18H3z" />
                        <path d="M3 12h18" />
                        <path d="M12 3v18" />
                    </svg>
                </div>
            </div>
            <p class="mt-5 text-sm text-slate-300">Total des marques dans l’inventaire.</p>
        </div>

        <!-- Commandes -->
        <div class="group overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-amber-900 p-6 text-white shadow-2xl shadow-amber-900/20 transition duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-300">Commandes</p>
                    <p class="mt-3 text-4xl font-semibold">
                        <span data-counter data-target="{{ $stats['orders'] }}">0</span>
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.85" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 3h18v18H3z" />
                        <path d="M9 7h6" />
                        <path d="M9 12h6" />
                        <path d="M9 17h4" />
                    </svg>
                </div>
            </div>
            <p class="mt-5 text-sm text-slate-300">Commandes générées par le système.</p>
        </div>

        <!-- Revenu -->
        <div class="group overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-violet-950 p-6 text-white shadow-2xl shadow-violet-900/20 transition duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-300">Revenu</p>
                    <p class="mt-3 text-4xl font-semibold">
                        {{ number_format($stats['revenue'], 2, ',', ' ') }} DH
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.85" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3v18" />
                        <path d="M5 6h14" />
                        <path d="M5 18h14" />
                    </svg>
                </div>
            </div>
            <p class="mt-5 text-sm text-slate-300">Chiffre d’affaires total en MAD.</p>
        </div>

        <!-- Prescriptions -->
        <div class="group overflow-hidden rounded-3xl bg-gradient-to-br from-slate-900 via-slate-800 to-fuchsia-950 p-6 text-white shadow-2xl shadow-fuchsia-900/20 transition duration-300 hover:-translate-y-1">
            <div class="flex items-center justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-[0.32em] text-slate-300">Prescriptions</p>
                    <p class="mt-3 text-4xl font-semibold">
                        <span data-counter data-target="{{ $stats['prescriptions'] }}">0</span>
                    </p>
                </div>
                <div class="flex h-14 w-14 items-center justify-center rounded-3xl bg-white/10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.85" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 3h6a2 2 0 012 2v14a2 2 0 01-2 2H9a2 2 0 01-2-2V5a2 2 0 012-2z" />
                        <path d="M9 7h6" />
                        <path d="M9 11h6" />
                        <path d="M9 15h4" />
                    </svg>
                </div>
            </div>
            <p class="mt-5 text-sm text-slate-300">Ordonnances gérées par le CRM.</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid gap-6 xl:grid-cols-[1.6fr_1.2fr]">
        <div class="grid gap-6">
            <!-- Performance du magasin -->
            <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-lg shadow-slate-200/10 backdrop-blur-xl">
                <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.24em] text-slate-500">Analyse</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">Performance du magasin</h2>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <button class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Mois</button>
                        <button class="rounded-2xl border border-slate-200 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">Trimestre</button>
                    </div>
                </div>

                <!-- Charts Grid -->
                <div class="mt-8 grid gap-6 xl:grid-cols-3">
                    <!-- Chart 1: Ventes -->
                    <div class="rounded-3xl bg-slate-950/95 p-6 text-white shadow-xl shadow-slate-900/20">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm uppercase tracking-[0.24em] text-slate-400">Ventes par mois</p>
                                <h3 class="mt-2 text-xl font-semibold">Répartition mensuelle</h3>
                            </div>
                            <span class="rounded-2xl bg-white/10 px-3 py-2 text-xs uppercase tracking-[0.24em] text-slate-200">+18%</span>
                        </div>
                        <div class="mt-6">
                            <canvas id="salesChart" class="h-64 w-full"></canvas>
                        </div>
                    </div>

                    <!-- Chart 2: Commandes -->
                    <div class="rounded-3xl bg-white p-6 shadow-xl shadow-slate-200/60">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Commandes par mois</p>
                                <h3 class="mt-2 text-xl font-semibold text-slate-900">Volume de commande</h3>
                            </div>
                            <span class="rounded-2xl bg-emerald-50 px-3 py-2 text-xs uppercase tracking-[0.24em] text-emerald-700">Stable</span>
                        </div>
                        <div class="mt-6">
                            <canvas id="ordersChart" class="h-64 w-full"></canvas>
                        </div>
                    </div>

                    <!-- Chart 3: Stock par marque -->
                    <div class="rounded-3xl bg-white p-6 shadow-xl shadow-slate-200/60">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Stock</p>
                                <h3 class="mt-2 text-xl font-semibold text-slate-900">Stock par marque</h3>
                            </div>
                            <span class="rounded-2xl bg-cyan-50 px-3 py-2 text-xs uppercase tracking-[0.24em] text-cyan-700">Inventaire</span>
                        </div>
                        <div class="mt-6">
                            <canvas id="stockBrandChart" class="h-64 w-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activité récente -->
            <div class="rounded-3xl border border-slate-200 bg-white/90 p-6 shadow-lg shadow-slate-200/10 backdrop-blur-xl">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Activité récente</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">Dernières actions</h2>
                    </div>
                    <span class="rounded-full bg-slate-100 px-3 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-slate-600">En direct</span>
                </div>

                <div class="mt-6 space-y-4">
                    @foreach($recentActivity as $activity)
                        <div class="group flex items-start gap-4 rounded-3xl border border-slate-200 bg-slate-50 p-4 transition hover:-translate-y-0.5 hover:shadow-sm">
                            <div class="flex h-12 w-12 items-center justify-center rounded-3xl bg-gradient-to-br {{ $activity['color'] }} text-white shadow-lg shadow-slate-900/10">
                                @if($activity['icon'] === 'user-add')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M15 14c2.761 0 5 2.239 5 5v1H4v-1c0-2.761 2.239-5 5-5" />
                                        <circle cx="12" cy="7" r="4" />
                                        <path d="M18 9h6" transform="translate(-12 -2)" />
                                    </svg>
                                @elseif($activity['icon'] === 'shopping-cart')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M6 6h15l-1.5 9H7.5L6 6z" />
                                        <path d="M6 6l-2-4" />
                                        <circle cx="9" cy="20" r="1" />
                                        <circle cx="18" cy="20" r="1" />
                                    </svg>
                                @elseif($activity['icon'] === 'clipboard-check')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M9 4h6" />
                                        <path d="M8 4v2H6v16h12V6h-2V4H8z" />
                                        <path d="M9 13l2 2 4-4" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 5v14" />
                                        <path d="M6 8h12" />
                                        <path d="M6 16h12" />
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="font-semibold text-slate-900">{{ $activity['title'] }}</p>
                                <p class="mt-1 text-sm leading-6 text-slate-500">{{ $activity['description'] }}</p>
                            </div>
                            <span class="text-xs uppercase tracking-[0.24em] text-slate-400">{{ $activity['time'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <aside class="space-y-6">
            <!-- Actions rapides -->
            <div class="rounded-3xl border border-slate-200 bg-white/95 p-6 shadow-lg shadow-slate-200/10 backdrop-blur-xl">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Actions rapides</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">Lancer une action</h2>
                    </div>
                </div>
                <div class="mt-6 grid gap-3">
                    <a href="{{ route('customers.create') }}" class="inline-flex items-center justify-center rounded-3xl bg-slate-950 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">+ Ajouter un client</a>
                    <a href="{{ route('orders.create') }}" class="inline-flex items-center justify-center rounded-3xl bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">+ Nouvelle commande</a>
                    <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center rounded-3xl bg-gradient-to-r from-cyan-500 to-blue-500 px-4 py-3 text-sm font-semibold text-white transition hover:from-cyan-600 hover:to-blue-600">+ Ajouter un produit</a>
                    <a href="{{ route('prescriptions.create') }}" class="inline-flex items-center justify-center rounded-3xl bg-gradient-to-r from-fuchsia-500 to-pink-500 px-4 py-3 text-sm font-semibold text-white transition hover:from-fuchsia-600 hover:to-pink-600">+ Ajouter une prescription</a>
                </div>
            </div>

            <!-- Stock faible -->
            <div class="rounded-3xl border border-slate-200 bg-white/95 p-6 shadow-lg shadow-slate-200/10 backdrop-blur-xl">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm uppercase tracking-[0.24em] text-slate-500">Stock faible</p>
                        <h2 class="mt-2 text-2xl font-semibold text-slate-900">Produits à surveiller</h2>
                    </div>
                    <span class="rounded-full bg-rose-50 px-3 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-rose-700">Alerte</span>
                </div>

                <div class="mt-6 space-y-4">
                    @forelse($lowStockProducts as $product)
                        <div class="group flex items-center justify-between gap-4 rounded-3xl border border-rose-100 bg-rose-50/80 px-4 py-4 transition hover:-translate-y-0.5 hover:shadow-sm">
                            <div>
                                <p class="font-semibold text-slate-900">{{ $product['name'] }}</p>
                                <p class="mt-1 text-sm text-slate-500">Quantité restante : {{ $product['quantity'] }}</p>
                            </div>
                            <span class="inline-flex items-center gap-2 rounded-full bg-white px-3 py-2 text-xs font-semibold text-rose-700 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 9v4" />
                                    <path d="M12 17h.01" />
                                    <path d="M12 21a9 9 0 100-18 9 9 0 000 18z" />
                                </svg>
                                Faible
                            </span>
                        </div>
                    @empty
                        <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-500">Aucun produit en stock faible pour le moment.</div>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Counter Animation
    const counters = document.querySelectorAll('[data-counter]');
    counters.forEach((counter) => {
        const updateCount = () => {
            const target = Number(counter.dataset.target) || 0;
            const duration = 1200;
            const step = Math.ceil(target / (duration / 16));
            let current = Number(counter.textContent.replace(/\D/g, '')) || 0;

            const increment = () => {
                current += step;
                if (current >= target) {
                    counter.textContent = target.toLocaleString();
                } else {
                    counter.textContent = current.toLocaleString();
                    requestAnimationFrame(increment);
                }
            };

            requestAnimationFrame(increment);
        };
        updateCount();
    });

    // Safe data extraction with fallbacks
    const salesLabels = @json($salesLabels ?? []);
    const salesData = @json($salesData ?? []);
    const ordersLabels = @json($ordersLabels ?? []);
    const ordersData = @json($ordersData ?? []);
    const stockBrandLabels = @json(isset($stockByBrand) ? $stockByBrand->pluck('brand') : []);
    const stockBrandData = @json(isset($stockByBrand) ? $stockByBrand->pluck('stock') : []);

    // Sales Chart
    const salesCtx = document.getElementById('salesChart');
    if (salesCtx && salesLabels.length) {
        const ctx = salesCtx.getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 280);
        gradient.addColorStop(0, 'rgba(59,130,246,0.55)');
        gradient.addColorStop(1, 'rgba(59,130,246,0.08)');

        new Chart(salesCtx, {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{
                    label: 'Ventes',
                    data: salesData,
                    borderColor: '#60A5FA',
                    backgroundColor: gradient,
                    tension: 0.35,
                    pointRadius: 4,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#3286ed',
                    fill: true,
                    borderWidth: 3,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true, labels: { color: '#64748b' } },
                    tooltip: { mode: 'index', intersect: false },
                },
                scales: {
                    x: { ticks: { color: '#94a3b8' }, grid: { display: false } },
                    y: { ticks: { color: '#94a3b8' }, grid: { color: 'rgba(148,163,184,0.16)' } },
                },
            },
        });
    }

    // Orders Chart
    const ordersCtx = document.getElementById('ordersChart');
    if (ordersCtx && ordersLabels.length) {
        new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: ordersLabels,
                datasets: [{
                    label: 'Commandes',
                    data: ordersData,
                    backgroundColor: 'rgba(59,130,246,0.85)',
                    borderRadius: 8,
                    barThickness: 'flex',
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'top', labels: { color: '#2a323f' } },
                    tooltip: { mode: 'index', intersect: false },
                },
                scales: {
                    x: { ticks: { color: '#94a3b8' }, grid: { display: false } },
                    y: { ticks: { color: '#94a3b8' }, grid: { color: 'rgba(148,163,184,0.16)' } },
                },
            },
        });
    }

    // Stock by Brand Chart
    const stockBrandCtx = document.getElementById('stockBrandChart');
    if (stockBrandCtx && stockBrandLabels.length) {
        new Chart(stockBrandCtx, {
            type: 'bar',
            data: {
                labels: stockBrandLabels,
                datasets: [{
                    label: 'Quantité en stock',
                    data: stockBrandData,
                    backgroundColor: 'rgba(34,211,238,0.85)',
                    borderRadius: 10,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: true }
                },
                scales: {
                    x: {
                        ticks: { color: '#94a3b8' },
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true, 
                        ticks: { color: '#94a3b8' }
                    }
                }
            }
        });
    }
</script>
@endsection