<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Optical CRM - @yield('page-title', 'Tableau de bord')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    
    <style>
        [x-cloak] { display: none !important; }
        
        .no-bounce { overscroll-behavior-y: none; }
        
        #main-scroll {
            scroll-behavior: smooth;
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 transparent;
        }
        
        #main-scroll::-webkit-scrollbar { width: 6px; }
        #main-scroll::-webkit-scrollbar-track { background: transparent; }
        #main-scroll::-webkit-scrollbar-thumb { background-color: #cbd5e1; border-radius: 20px; }
    </style>
</head>
<body class="font-sans text-slate-900 bg-slate-50 antialiased">
    
    <div x-data="{ mobileMenuOpen: false }" class="flex h-screen overflow-hidden bg-gradient-to-br from-slate-50 via-white to-indigo-50/40 no-bounce">

        <!-- ========================================== -->
        <!-- SIDEBAR -->
        <!-- ========================================== -->
        <aside class="fixed inset-y-0 left-0 z-40 w-72 transform bg-gradient-to-b from-indigo-950 via-slate-950 to-slate-950 text-slate-100 shadow-2xl transition duration-300 md:translate-x-0"
               :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="flex h-full flex-col">
                
               <!-- Logo -->
<div class="flex items-center justify-between px-6 py-6 border-b border-white/10 flex-shrink-0">
    <div class="flex items-center gap-3">
        <!-- Improved Logo Icon -->
        <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-fuchsia-500 shadow-lg shadow-indigo-500/30 ring-1 ring-white/20">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
    <line x1="3" y1="9" x2="21" y2="9"/>
    <line x1="9" y1="21" x2="9" y2="9"/>
</svg>
        </div>
        <div>
            <span class="text-lg font-bold tracking-tight text-white">Optical CRM</span>
            <p class="text-xs font-medium text-indigo-300/80">Gestion interne</p>
        </div>
    </div>
    <button type="button" class="inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 p-2 text-slate-300 hover:bg-white/10 md:hidden"
            @click="mobileMenuOpen = false">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
        </svg>
    </button>
</div>

                <!-- Navigation -->
                <nav class="flex-1 overflow-y-auto px-4 py-6">
                    <p class="px-4 pb-2 text-[11px] font-semibold uppercase tracking-[0.28em] text-indigo-300/70">Menu principal</p>
                    <div class="space-y-1.5">
                        
                        <a href="{{ route('dashboard') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>
                            </svg>
                            Tableau de bord
                        </a>

                        <a href="{{ route('reservations.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('reservations.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>
                            </svg>
                            Réservations
                        </a>

                        <a href="{{ route('customers.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('customers.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                            </svg>
                            Clients
                        </a>

                        <a href="{{ route('orders.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('orders.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/>
                            </svg>
                            Commandes
                        </a>

                        <a href="{{ route('products.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>
                            </svg>
                            Produits
                        </a>

                        <!-- UNIFORMISÉ : Fournisseurs -->
                        <a href="{{ route('suppliers.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('suppliers.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>
                            </svg>
                            Fournisseurs
                        </a>

                        <!-- UNIFORMISÉ : Bons de Commande -->
                        <a href="{{ route('purchase-orders.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('purchase-orders.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                            </svg>
                            Bons de Commande
                        </a>

                        <a href="{{ route('prescriptions.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('prescriptions.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                            </svg>
                            Ordonnances
                        </a>

                        <a href="{{ route('categories.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('categories.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>
                            </svg>
                            Catégories
                        </a>
                    </div>

                    <!-- Administration -->
                    <p class="px-4 pb-2 pt-8 text-[11px] font-semibold uppercase tracking-[0.28em] text-indigo-300/50">Administration</p>
                    <div class="space-y-1.5">
                        
                        <a href="{{ route('invoices.index') }}" 
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('invoices.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
                            </svg>
                            Factures
                        </a>

                                        <a href="{{ route('reports.index') }}"
                class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('reports.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 3v18h18"/><path d="M18 17V9"/><path d="M13 17V5"/><path d="M8 17v-3"/>
                    </svg>
                    Rapports & Analyses
                </a>

                        @role('Admin')
                            <a href="{{ route('users.index') }}"
                               class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('users.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                                Utilisateurs
                            </a>

                            <a href="{{ route('settings.index') }}"
                               class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('settings.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/>
                                </svg>
                                Paramètres
                            </a>
                        @endrole
                    </div>
                </nav>

                <!-- Support Box -->
                <div class="border-t border-white/10 px-6 py-5 flex-shrink-0">
                    <div class="rounded-2xl bg-gradient-to-br from-indigo-500/20 to-fuchsia-500/10 border border-white/10 p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-indigo-300">Besoin d'aide ?</p>
                        <p class="mt-2 text-sm leading-6 text-slate-300">Contactez l'équipe IT pour toute demande de support interne.</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Mobile Overlay -->
        <div x-show="mobileMenuOpen" x-cloak class="fixed inset-0 z-30 bg-slate-950/60 backdrop-blur-sm md:hidden" @click="mobileMenuOpen = false"></div>

        <!-- ========================================== -->
        <!-- MAIN CONTENT WRAPPER --> 
        <!-- ========================================== -->
        <div class="flex flex-1 flex-col overflow-hidden md:pl-72">
            
            <!-- HEADER -->
            <header class="flex-shrink-0 z-20 border-b border-slate-200/70 bg-white/90 backdrop-blur-md">
                <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                    
                    <!-- Left: Mobile menu + Title -->
                    <div class="flex items-center gap-4">
                        <button type="button" class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-700 md:hidden" @click="mobileMenuOpen = true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm1 4a1 1 0 100 2h12a1 1 0 100-2H4z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div>
                            <p class="text-xs uppercase tracking-[0.24em] text-indigo-500 font-semibold">Interface interne</p>
                            <h1 class="text-lg font-semibold tracking-tight text-slate-900">@yield('page-title' , 'Tableau de bord')</h1>
                        </div>
                    </div>
                
                    <!-- Right: Search, Notifications, Profile -->
                    <div class="flex items-center gap-3">
                        
                        <!-- Search Bar -->
                        <div class="relative hidden sm:block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <path d="m21 21-4.3-4.3"></path>
                            </svg>
                            <input type="text" placeholder="Rechercher..." class="h-9 w-64 rounded-lg border border-slate-200 bg-slate-50 pl-9 pr-4 text-sm text-slate-700 placeholder-slate-400 transition focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
                        </div>

                        <!-- Dynamic Notifications Dropdown -->
                        <div class="relative" x-data="{ 
                            notifOpen: false, 
                            notifications: [], 
                            unreadCount: 0,
                            init() {
                                this.fetchNotifications();
                                setInterval(() => this.fetchNotifications(), 30000);
                            },
                            async fetchNotifications() {
                                try {
                                    const response = await fetch('{{ route('notifications.list') }}');
                                    const data = await response.json();
                                    this.notifications = data.notifications;
                                    this.unreadCount = data.unread_count;
                                } catch (e) { console.error('Notification fetch failed', e); }
                            },
                            async markAsRead(id, link) {
                                await fetch(`/notifications/read/${id}`, { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } });
                                this.fetchNotifications();
                                window.location.href = link;
                            },
                            async markAllRead() {
                                await fetch('{{ route('notifications.read-all') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content } });
                                this.fetchNotifications();
                            }
                        }">
                            <button @click="notifOpen = !notifOpen" class="relative inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-indigo-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"></path>
                                    <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0"></path>
                                </svg>
                                <span x-show="unreadCount > 0" x-text="unreadCount" class="absolute -top-1 -right-1 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-[10px] font-bold text-white ring-2 ring-white" x-transition></span>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="notifOpen" @click.away="notifOpen = false" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-80 origin-top-right rounded-xl border border-slate-200 bg-white py-2 shadow-xl ring-1 ring-black ring-opacity-5 focus:outline-none z-50 max-h-96 overflow-y-auto">
                                
                                <div class="flex items-center justify-between px-4 py-2 border-b border-slate-100">
                                    <h3 class="text-sm font-bold text-slate-900">Notifications</h3>
                                    <button @click="markAllRead()" x-show="unreadCount > 0" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Tout marquer lu</button>
                                </div>

                                <div x-show="notifications.length === 0" class="p-8 text-center text-sm text-slate-500">
                                    Aucune notification.
                                </div>
                            
                                

                                <template x-for="notif in notifications" :key="notif.id">
                                    <div @click="markAsRead(notif.id, notif.link)" class="flex items-start gap-3 px-4 py-3 hover:bg-slate-50 cursor-pointer transition border-b border-slate-50 last:border-0" :class="{ 'bg-indigo-50/30': !notif.read_at }">
                                        <div class="flex-shrink-0 mt-1">
                                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-lg">
                                                <span x-text="notif.icon === 'alert' ? '⚠️' : (notif.icon === 'cart' ? '🛒' : '📅')"></span>
                                            </span>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm text-slate-800" x-text="notif.message"></p>
                                            <p class="text-xs text-slate-400 mt-1" x-text="notif.created_at"></p>
                                        </div>
                                        <div x-show="!notif.read_at" class="h-2 w-2 rounded-full bg-indigo-500 mt-2"></div>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Profile Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            <button type="button" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50" @click="open = !open">
                                <span class="flex h-7 w-7 items-center justify-center rounded-full bg-indigo-100 text-xs font-semibold text-indigo-700">
                                    {{ Str::substr(optional(Auth::user())->name ?? 'U', 0, 1) }}
                                </span>
                                <span class="hidden text-sm font-medium text-slate-700 md:block">{{ optional(Auth::user())->name ?? 'Utilisateur' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition hidden md:block" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.938l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <!-- Profile Dropdown Menu -->
                            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute right-0 mt-2 w-56 origin-top-right rounded-xl border border-slate-200 bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                        Mon profil
                                    </div>
                                </a>
                                <a href="{{ route('settings.index') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 hover:text-indigo-600">
                                    <div class="flex items-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                                        Paramètres
                                    </div>
                                </a>
                                <div class="my-1 border-t border-slate-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full px-4 py-2 text-left text-sm text-rose-600 hover:bg-rose-50">
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                            Déconnexion
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- MAIN CONTENT -->
            <main id="main-scroll" class="flex-1 overflow-y-auto bg-slate-50">
                <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                    @if(session('success'))
                        <x-flash-message type="success" :message="session('success')" class="mb-6" />
                    @endif

                    @if(session('error'))
                        <x-flash-message type="error" :message="session('error')" class="mb-6" />
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mainScroll = document.getElementById('main-scroll');
            if (mainScroll) {
                mainScroll.scrollTop = 0;
            }
        });
    </script>

    @stack('scripts')
</body>
</html>