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

<style>
    @keyframes float { 0%, 100% { transform: translate(0, 0) scale(1); } 50% { transform: translate(20px, -20px) scale(1.05); } }
    @keyframes float-slow { 0%, 100% { transform: translate(0, 0) scale(1); } 50% { transform: translate(-30px, 30px) scale(1.1); } }
    @keyframes pulse-glow { 0%, 100% { opacity: 0.4; } 50% { opacity: 0.7; } }
    @keyframes fade-in-up { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes slide-in-right { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes rotate-slow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
    
    .animate-float { animation: float 8s ease-in-out infinite; }
    .animate-float-slow { animation: float-slow 12s ease-in-out infinite; }
    .animate-pulse-glow { animation: pulse-glow 4s ease-in-out infinite; }
    .animate-fade-in-up { animation: fade-in-up 0.6s ease-out forwards; opacity: 0; }
    .animate-slide-in-right { animation: slide-in-right 0.5s ease-out forwards; opacity: 0; }
    .animate-rotate-slow { animation: rotate-slow 20s linear infinite; }
    
    .delay-100 { animation-delay: 0.1s; } .delay-200 { animation-delay: 0.2s; } .delay-300 { animation-delay: 0.3s; }
    .delay-400 { animation-delay: 0.4s; } .delay-500 { animation-delay: 0.5s; } .delay-600 { animation-delay: 0.6s; }
    
    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .gradient-border {
        position: relative; background: white; border-radius: 1rem;
    }
    .gradient-border::before {
        content: ''; position: absolute; inset: 0; border-radius: 1rem; padding: 1px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.3), rgba(168, 85, 247, 0.3), rgba(56, 189, 248, 0.3));
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor; mask-composite: exclude; pointer-events: none;
    }
    
    .stat-card {
        position: relative; overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card:hover { transform: translateY(-4px) scale(1.02); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15); }
    .stat-card::after {
        content: ''; position: absolute; top: -50%; right: -50%; width: 100%; height: 100%;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
        opacity: 0; transition: opacity 0.4s ease; pointer-events: none;
    }
    .stat-card:hover::after { opacity: 1; }
    
    .icon-float { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .stat-card:hover .icon-float { transform: translateY(-4px) rotate(5deg) scale(1.1); }
    
    .btn-premium {
        position: relative; overflow: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-premium::before {
        content: ''; position: absolute; top: 50%; left: 50%; width: 0; height: 0; border-radius: 50%;
        background: rgba(255, 255, 255, 0.3); transform: translate(-50%, -50%);
        transition: width 0.6s ease, height 0.6s ease;
    }
    .btn-premium:hover::before { width: 300px; height: 300px; }
    .btn-premium:hover { transform: translateY(-2px); box-shadow: 0 10px 30px -10px rgba(99, 102, 241, 0.5); }
    .btn-premium:active { transform: translateY(0) scale(0.98); }
    
    .activity-item { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .activity-item:hover { transform: translateX(4px); background: rgba(248, 250, 252, 0.8); }
    
    .timeline-line {
        position: absolute; left: 20px; top: 40px; bottom: 0; width: 2px;
        background: linear-gradient(to bottom, #e2e8f0, transparent);
    }
    
    .sparkline { stroke-dasharray: 100; stroke-dashoffset: 100; animation: draw-line 2s ease-out forwards; }
    @keyframes draw-line { to { stroke-dashoffset: 0; } }
    
    .hero-shape { position: absolute; border-radius: 50%; filter: blur(60px); opacity: 0.5; }
    
    .scroll-reveal { opacity: 0; transform: translateY(20px); transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1); }
    .scroll-reveal.visible { opacity: 1; transform: translateY(0); }
    
    .number-counter { display: inline-block; animation: fade-in-up 0.5s ease-out forwards; }
    
    .glow-indigo { box-shadow: 0 0 40px rgba(99, 102, 241, 0.3); }
    .glow-violet { box-shadow: 0 0 40px rgba(139, 92, 246, 0.3); }
    .glow-cyan { box-shadow: 0 0 40px rgba(56, 189, 248, 0.3); }
    .glow-emerald { box-shadow: 0 0 40px rgba(16, 185, 129, 0.3); }
    .glow-amber { box-shadow: 0 0 40px rgba(245, 158, 11, 0.3); }
    .glow-rose { box-shadow: 0 0 40px rgba(244, 63, 94, 0.3); }
    
    .premium-bg {
        background: 
            radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.08) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(168, 85, 247, 0.06) 0%, transparent 50%),
            radial-gradient(circle at 40% 80%, rgba(56, 189, 248, 0.05) 0%, transparent 50%);
    }
</style>

<!-- Premium Background with Floating Blobs -->
<div class="fixed inset-0 overflow-hidden pointer-events-none -z-10">
    <div class="hero-shape animate-float bg-indigo-400/30 w-96 h-96 -top-48 -left-48"></div>
    <div class="hero-shape animate-float-slow bg-violet-400/20 w-80 h-80 top-1/4 -right-40"></div>
    <div class="hero-shape animate-float bg-cyan-400/20 w-72 h-72 bottom-1/4 left-1/3"></div>
</div>

<div class="premium-bg space-y-8">
    
    <!-- ========================================== -->
    <!-- 1. HERO SECTION -->
    <!-- ========================================== -->
    <div class="relative overflow-hidden rounded-3xl glass-card p-8 md:p-10 shadow-2xl animate-fade-in-up">
        <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-indigo-500/20 to-violet-500/20 rounded-full blur-3xl animate-pulse-glow"></div>
        <div class="absolute -top-20 -right-20 w-64 h-64 border border-indigo-500/10 rounded-full animate-rotate-slow"></div>
        
        <div class="relative z-10">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="flex-1">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-indigo-500/10 border border-indigo-500/20 mb-4">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                        </span>
                        <span class="text-xs font-semibold text-indigo-700 uppercase tracking-wider">En direct</span>
                    </div>
                    
                    <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold bg-gradient-to-r from-slate-900 via-indigo-900 to-violet-900 bg-clip-text text-transparent mb-3">
                        Bonjour, {{ Auth::user()->name }} 👋
                    </h1>
                    <p class="text-lg text-slate-600 mb-6">Voici un aperçu de l'activité de votre magasin aujourd'hui.</p>
                    
                    <div class="flex flex-wrap gap-4">
                        <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/60 border border-slate-200/50 shadow-sm">
                            <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <span class="text-sm font-medium text-slate-700">{{ now()->translatedFormat('l d F Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2 px-4 py-2 rounded-xl bg-white/60 border border-slate-200/50 shadow-sm">
                            <svg class="w-4 h-4 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span class="text-sm font-medium text-slate-700" id="live-time">{{ now()->format('H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Stats in Hero -->
                <div class="grid grid-cols-2 gap-3 lg:gap-4">
                    <div class="glass-card rounded-2xl p-4 border border-white/50 shadow-lg">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Revenu</p>
                        <p class="text-2xl font-bold text-slate-900 mt-1">{{ number_format($stats['revenue'], 0, ',', ' ') }} <span class="text-base font-medium text-slate-500">DH</span></p>
                        <p class="text-xs text-emerald-600 font-medium mt-1">↑ 12.5%</p>
                    </div>
                    <div class="glass-card rounded-2xl p-4 border border-white/50 shadow-lg">
                        <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Commandes</p>
                        <p class="text-2xl font-bold text-slate-900 mt-1">{{ $stats['orders'] }}</p>
                        <p class="text-xs text-indigo-600 font-medium mt-1">↑ 8.2%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 2. QUICK ACTIONS (Moved to Top) -->
    <!-- ========================================== -->
    <div class="grid gap-4 sm:grid-cols-3 animate-fade-in-up delay-200">
        <a href="{{ route('customers.create') }}" class="btn-premium group flex items-center gap-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-violet-600 p-5 text-white shadow-lg shadow-indigo-500/20 transition hover:scale-[1.02]">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
            </div>
            <div class="flex-1">
                <p class="font-bold text-lg">Nouveau client</p>
                <p class="text-xs text-white/80">Ajouter un client au CRM</p>
            </div>
            <svg class="h-6 w-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        <a href="{{ route('orders.create') }}" class="btn-premium group flex items-center gap-4 rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-600 p-5 text-white shadow-lg shadow-cyan-500/20 transition hover:scale-[1.02]">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
            </div>
            <div class="flex-1">
                <p class="font-bold text-lg">Nouvelle commande</p>
                <p class="text-xs text-white/80">Créer une vente rapide</p>
            </div>
            <svg class="h-6 w-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>

        <a href="{{ route('products.create') }}" class="btn-premium group flex items-center gap-4 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-600 p-5 text-white shadow-lg shadow-emerald-500/20 transition hover:scale-[1.02]">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white/20 backdrop-blur-sm">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div class="flex-1">
                <p class="font-bold text-lg">Nouveau produit</p>
                <p class="text-xs text-white/80">Ajouter au catalogue</p>
            </div>
            <svg class="h-6 w-6 transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    <!-- ========================================== -->
    <!-- 3. STATISTICS CARDS (6 Cards) -->
    <!-- ========================================== -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
        @php
            $statCards = [
                ['label' => 'Clients', 'value' => $stats['customers'], 'trend' => '+12.5%', 'trendUp' => true, 'icon' => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>', 'gradient' => 'from-indigo-500 to-violet-600', 'glow' => 'glow-indigo', 'sparkData' => [30, 45, 35, 50, 40, 60, 55, 70, 65, 80]],
                ['label' => 'Produits', 'value' => $stats['products'], 'trend' => '+5.3%', 'trendUp' => true, 'icon' => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>', 'gradient' => 'from-cyan-500 to-blue-600', 'glow' => 'glow-cyan', 'sparkData' => [20, 25, 30, 28, 35, 40, 38, 45, 50, 48]],
                ['label' => 'Marques', 'value' => $stats['brands'], 'trend' => '+2.1%', 'trendUp' => true, 'icon' => '<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>', 'gradient' => 'from-emerald-500 to-teal-600', 'glow' => 'glow-emerald', 'sparkData' => [10, 12, 11, 14, 13, 15, 16, 15, 17, 18]],
                ['label' => 'Commandes', 'value' => $stats['orders'], 'trend' => '+18.7%', 'trendUp' => true, 'icon' => '<path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>', 'gradient' => 'from-amber-500 to-orange-600', 'glow' => 'glow-amber', 'sparkData' => [15, 20, 18, 25, 30, 28, 35, 40, 38, 45]],
                ['label' => 'Prescriptions', 'value' => $stats['prescriptions'], 'trend' => '+7.4%', 'trendUp' => true, 'icon' => '<path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>', 'gradient' => 'from-rose-500 to-pink-600', 'glow' => 'glow-rose', 'sparkData' => [8, 12, 10, 15, 18, 16, 20, 22, 25, 28]],
                ['label' => 'Revenu Total', 'value' => number_format($stats['revenue'], 0, ',', ' ') . ' DH', 'trend' => '+24.3%', 'trendUp' => true, 'icon' => '<line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>', 'gradient' => 'from-violet-500 to-fuchsia-600', 'glow' => 'glow-violet', 'sparkData' => [100, 150, 130, 180, 200, 190, 220, 250, 240, 280]],
            ];
        @endphp

        @foreach($statCards as $index => $stat)
            <div class="stat-card gradient-border rounded-2xl bg-white p-6 shadow-lg animate-fade-in-up delay-{{ ($index + 1) * 100 }}">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-gradient-to-br {{ $stat['gradient'] }} rounded-full opacity-10 blur-2xl"></div>
                <div class="relative">
                    <div class="flex items-start justify-between mb-4">
                        <div class="icon-float flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br {{ $stat['gradient'] }} text-white shadow-lg {{ $stat['glow'] }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $stat['icon'] !!}</svg>
                        </div>
                        <div class="flex items-center gap-1 px-2 py-1 rounded-lg {{ $stat['trendUp'] ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $stat['trendUp'] ? 'M7 17l5-5 5 5M7 7l5 5 5-5' : 'M17 7l-5 5-5-5M17 17l-5-5-5 5' }}"/></svg>
                            <span class="text-xs font-bold">{{ $stat['trend'] }}</span>
                        </div>
                    </div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wider mb-1">{{ $stat['label'] }}</p>
                    <p class="text-2xl font-bold text-slate-900 number-counter" data-target="{{ is_numeric(str_replace([' ', 'DH', ','], '', $stat['value'])) ? str_replace([' ', 'DH', ','], '', $stat['value']) : 0 }}">
                        {{ $stat['value'] }}
                    </p>
                    <div class="mt-4 h-8">
                        <svg class="w-full h-full" viewBox="0 0 100 30" preserveAspectRatio="none">
                            <defs><linearGradient id="sparkGrad{{ $index }}" x1="0" y1="0" x2="0" y2="1"><stop offset="0%" stop-color="currentColor" stop-opacity="0.3"/><stop offset="100%" stop-color="currentColor" stop-opacity="0"/></linearGradient></defs>
                            <path d="{{ 'M0,' . (30 - $stat['sparkData'][0] * 0.3) . ' ' . collect($stat['sparkData'])->map(function($v, $i) { return 'L' . ($i * 100 / 9) . ',' . (30 - $v * 0.3); })->implode(' ') }}" fill="none" stroke="url(#sparkGrad{{ $index }})" stroke-width="2" class="sparkline text-indigo-500"/>
                        </svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- ========================================== -->
    <!-- 4. CHARTS SECTION (Only 2 Charts Now) -->
    <!-- ========================================== -->
    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Chart 1: Ventes (Wide) -->
        <div class="scroll-reveal relative overflow-hidden rounded-3xl glass-card p-6 shadow-xl lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Évolution des ventes</h3>
                    <p class="text-sm text-slate-500">Chiffre d'affaires sur les 12 derniers mois</p>
                </div>
                <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 border border-emerald-200">+18% ce mois</span>
            </div>
            <div class="relative h-72">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <!-- Chart 2: Commandes (Narrow) -->
        <div class="scroll-reveal relative overflow-hidden rounded-3xl glass-card p-6 shadow-xl">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Volume</h3>
                    <p class="text-sm text-slate-500">Commandes par mois</p>
                </div>
            </div>
            <div class="relative h-72">
                <canvas id="ordersChart"></canvas>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- 5. BOTTOM GRID: Activity & Low Stock -->
    <!-- ========================================== -->
    <div class="grid gap-6 xl:grid-cols-3">
        <!-- Recent Activity Timeline -->
        <div class="scroll-reveal relative overflow-hidden rounded-3xl glass-card p-6 shadow-xl xl:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Activité récente</h3>
                    <p class="text-sm text-slate-500">Dernières actions effectuées</p>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 rounded-full bg-emerald-50 border border-emerald-200">
                    <span class="relative flex h-2 w-2"><span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span><span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span></span>
                    <span class="text-xs font-semibold text-emerald-700">En direct</span>
                </div>
            </div>

            <div class="relative space-y-4">
                <div class="timeline-line"></div>
                @forelse($recentActivity as $index => $activity)
                    <div class="activity-item relative flex items-start gap-4 p-4 rounded-2xl border border-slate-100 bg-white/50 animate-slide-in-right" style="animation-delay: {{ $index * 0.1 }}s;">
                        <div class="relative z-10 flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-gradient-to-br {{ $activity['color'] }} text-white shadow-lg ring-4 ring-white">
                            @if($activity['icon'] === 'shopping-cart')
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            @elseif($activity['icon'] === 'clipboard-check')
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                            @else
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between gap-2">
                                <p class="text-sm font-semibold text-slate-900">{{ $activity['title'] }}</p>
                                <span class="flex-shrink-0 text-xs font-medium text-slate-400 bg-slate-100 px-2 py-1 rounded-lg">{{ $activity['time'] }}</span>
                            </div>
                            <p class="mt-1 text-sm text-slate-600 truncate">{{ $activity['description'] }}</p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 mb-4">
                            <svg class="h-8 w-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <p class="text-sm text-slate-500">Aucune activité récente</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="scroll-reveal relative overflow-hidden rounded-3xl glass-card p-6 shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-slate-900">Stock faible</h3>
                <span class="inline-flex items-center rounded-full bg-rose-50 px-2 py-1 text-xs font-semibold text-rose-700 border border-rose-200">{{ count($lowStockProducts) }} alertes</span>
            </div>
            <div class="space-y-3">
                @forelse($lowStockProducts as $product)
                    <div class="group flex items-center gap-4 p-3 rounded-2xl border border-rose-100 bg-gradient-to-r from-rose-50/50 to-white transition-all hover:shadow-lg hover:border-rose-200 hover:-translate-y-0.5">
                        <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 text-white shadow-lg shadow-rose-500/30">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-900 truncate">{{ $product['name'] }}</p>
                            <p class="text-xs text-rose-600 font-medium mt-0.5">Reste: {{ $product['quantity'] }} unités</p>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-emerald-200 bg-gradient-to-br from-emerald-50 to-white p-4 text-center">
                        <p class="text-sm font-semibold text-emerald-900">Tout va bien !</p>
                        <p class="text-xs text-emerald-600 mt-1">Aucun produit en rupture</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Live Time Update
    function updateTime() {
        const now = new Date();
        const el = document.getElementById('live-time');
        if (el) el.textContent = now.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
    }
    setInterval(updateTime, 1000);
    
    // Counter Animation
    document.querySelectorAll('.number-counter').forEach(counter => {
        const target = parseInt(counter.dataset.target) || 0;
        let current = 0;
        const step = target / 100;
        const updateCounter = () => {
            current += step;
            if (current < target) {
                counter.textContent = Math.ceil(current).toLocaleString('fr-FR');
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target.toLocaleString('fr-FR');
            }
        };
        new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) { updateCounter(); }
        }).observe(counter);
    });
    
    // Scroll Reveal
    document.querySelectorAll('.scroll-reveal').forEach(el => {
        new IntersectionObserver(entries => {
            if (entries[0].isIntersecting) el.classList.add('visible');
        }, { threshold: 0.1 }).observe(el);
    });
    
    // Chart Data
    const salesLabels = @json($salesLabels ?? []);
    const salesData = @json($salesData ?? []);
    const ordersLabels = @json($ordersLabels ?? []);
    const ordersData = @json($ordersData ?? []);

    // Chart 1: Sales
    if (document.getElementById('salesChart') && salesLabels.length) {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const gradient = ctx.createLinearGradient(0, 0, 0, 300);
        gradient.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
        gradient.addColorStop(1, 'rgba(99, 102, 241, 0)');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: salesLabels,
                datasets: [{ label: 'Chiffre d\'affaires', data: salesData, borderColor: '#6366f1', backgroundColor: gradient, borderWidth: 3, tension: 0.4, fill: true, pointRadius: 0, pointHoverRadius: 8, pointHoverBackgroundColor: '#ffffff', pointHoverBorderColor: '#6366f1', pointHoverBorderWidth: 3 }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false }, tooltip: { backgroundColor: 'rgba(15, 23, 42, 0.95)', titleColor: '#ffffff', bodyColor: '#cbd5e1', padding: 12, cornerRadius: 8, callbacks: { label: c => c.parsed.y.toLocaleString('fr-FR') + ' DH' } } }, scales: { x: { grid: { display: false }, ticks: { color: '#64748b', font: { size: 11 } } }, y: { grid: { color: '#f1f5f9' }, ticks: { color: '#64748b', font: { size: 11 }, callback: v => v / 1000 + 'k' } } } }
        });
    }

    // Chart 2: Orders
    if (document.getElementById('ordersChart') && ordersLabels.length) {
        new Chart(document.getElementById('ordersChart'), {
            type: 'bar',
            data: { labels: ordersLabels, datasets: [{ label: 'Commandes', data: ordersData, backgroundColor: 'rgba(56, 189, 248, 0.8)', borderRadius: 8, barThickness: 'flex' }] },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { x: { grid: { display: false }, ticks: { color: '#64748b', font: { size: 11 } } }, y: { grid: { color: '#f1f5f9' }, ticks: { color: '#64748b', font: { size: 11 } } } } }
        });
    }
</script>

@endsection