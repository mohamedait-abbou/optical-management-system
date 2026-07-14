<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Optical CRM - @yield('page-title', 'Tableau de bord')</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

@stack('styles')

</head>
<body class="font-sans text-slate-900 bg-gradient-to-br from-slate-50 via-white to-indigo-50/40">
    <div x-data="{ mobileMenuOpen: false }" class="min-h-screen flex">

        <!-- Sidebar -->
        <aside class="fixed inset-y-0 left-0 z-40 w-72 transform bg-gradient-to-b from-indigo-950 via-slate-950 to-slate-950 text-slate-100 shadow-2xl transition duration-300 md:translate-x-0"
               :class="mobileMenuOpen ? 'translate-x-0' : '-translate-x-full'">
            <div class="flex h-full flex-col">
                <div class="flex items-center justify-between px-6  py-5 border-b border-white/10">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-400 to-fuchsia-500 shadow-lg shadow-indigo-900/40">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="6" cy="12" r="3" /><circle cx="18" cy="12" r="3" /><path d="M9 12h6" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-lg font-semibold tracking-tight">Optical CRM</span>
                            <p class="text-xs text-indigo-300">Gestion interne</p>
                        </div>
                    </div>
                    <button type="button" class="inline-flex items-center justify-center rounded-lg border border-white/10 bg-white/5 p-2 text-slate-300 hover:bg-white/10 md:hidden"
                            @click="mobileMenuOpen = false">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5">
                          <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 011.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <nav class="flex-1 overflow-y-auto px-4 py-6">
                    <p class="px-4 pb-2 text-[11px] font-semibold uppercase tracking-[0.28em] text-indigo-300/70">Menu principal</p>
                    <div class="space-y-1.5">

                        <a href="{{ route('dashboard') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.707 1.293a1 1 0 00-1.414 0L2 8.586V18a1 1 0 001 1h5a1 1 0 001-1v-4h2v4a1 1 0 001 1h5a1 1 0 001-1V8.586l-7.293-7.293z" />
                            </svg>
                            Tableau de bord
                        </a>





                        
                             </a>
                                                        <a href="{{ route('reservations.index') }}"
                                class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('reservations.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Réservations
                            </a>


                        <a href="{{ route('customers.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('customers.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M23 21v-2a4 4 0 00-3-3.87" />
                                <path d="M16 3.13a4 4 0 010 7.75" />
                            </svg>
                            Clients
                        </a>

                        <a href="{{ route('orders.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('orders.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                                <path d="M8 7h8" />
                                <path d="M8 12h8" />
                                <path d="M8 17h5" />
                            </svg>
                            Commandes
                        </a>

                        <a href="{{ route('products.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 7h16M4 12h16M4 17h16" />
                            </svg>
                            Produits
                        </a>

                        <a href="{{ route('prescriptions.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('prescriptions.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 3h6a2 2 0 012 2v14a2 2 0 01-2 2H9a2 2 0 01-2-2V5a2 2 0 012-2z" />
                                <path d="M9 7h6" />
                                <path d="M9 11h6" />
                                <path d="M9 15h4" />
                            </svg>
                           ordonnances
                        <a href="{{ route('categories.index') }}"
                           class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('categories.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 7a2 2 0 012-2h4l2 2h8a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                            </svg>
                            Catégories
                        </a>


                        <p class="px-4 pb-2 pt-5 text-[11px] font-semibold uppercase tracking-[0.28em] text-indigo-300/50">À venir</p>

                        

                        <a href="{{ route('invoices.index') }}" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('invoices.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg shadow-indigo-900/30' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16v16H4z" />
                                <path d="M8 10h8M8 14h4" />
                            </svg>
                            Factures
                        </a>

                        <a href="#" class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium text-slate-500 cursor-not-allowed" title="Module à venir">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 3v18h18" />
                                <path d="M9 3v18" />
                                <path d="M15 8l3 2.5L15 13" />
                                <path d="M15 13v6" />
                            </svg>
                            Rapports
                        </a>
                    </div>
                </nav>
                                @role('Admin')
                <a href="{{ route('users.index') }}"
                class="group flex items-center gap-3 rounded-2xl px-4 py-3 text-sm font-medium transition-all duration-150 {{ request()->routeIs('users.*') ? 'bg-gradient-to-r from-indigo-500 to-fuchsia-500 text-white shadow-lg' : 'text-slate-300 hover:bg-white/5 hover:text-white' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75" />
                    </svg>
                    Utilisateurs
                </a>

                                <li>
                    <a href="{{ route('settings.index') }}" class="flex items-center gap-3 px-4 py-3 text-slate-300 rounded-xl hover:bg-white/10 hover:text-white transition {{ request()->routeIs('settings.*') ? 'bg-white/10 text-white' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.09a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                        Paramètres
                    </a>
                </li>
                @endrole

                <div class="border-t border-white/10 px-6 py-5">
                    <div class="rounded-2xl bg-gradient-to-br from-indigo-500/20 to-fuchsia-500/10 border border-white/10 p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-indigo-300">Besoin d'aide ?</p>
                        <p class="mt-2 text-sm leading-6 text-slate-300">Contactez l'équipe IT pour toute demande de support interne.</p>
                    </div>
                </div>
            </div>
        </aside>

        <div x-show="mobileMenuOpen" x-cloak class="fixed inset-0 z-30 bg-slate-950/60 backdrop-blur-sm md:hidden" @click="mobileMenuOpen = false"></div>

        <!-- Content -->
        <div class="flex-1 min-h-screen md:pl-72 overflow-hidden">
            <div class="flex min-h-screen flex-col">
                <header class="sticky top-0 z-10 border-b border-slate-200/70 bg-white/90 backdrop-blur-md">
                    <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 sm:px-6 lg:px-8 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-center gap-3">
                        <button type="button" class="inline-flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-700 transition hover:bg-slate-50 md:hidden"
                                @click="mobileMenuOpen = true">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm1 4a1 1 0 100 2h12a1 1 0 100-2H4z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <div>
                            <p class="text-xs uppercase tracking-[0.24em] text-indigo-500 font-semibold">Interface interne</p>
                            <h1 class="text-lg font-semibold tracking-tight text-slate-900">@yield('page-title', 'Tableau de bord')</h1>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
                        <div class="hidden sm:flex sm:items-center sm:gap-4">
                            <div class="rounded-2xl bg-indigo-50 border border-indigo-100 px-4 py-2 text-sm text-indigo-700 break-words">
                                {{ optional(Auth::user())->email }}
                            </div>
                        </div>

                        <div class="relative" x-data="{ open: false }">
                            <button type="button" class="inline-flex items-center gap-3 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 shadow-sm transition hover:shadow-md hover:border-indigo-200"
                                    @click="open = !open">
                                <span class="h-9 w-9 overflow-hidden rounded-full bg-gradient-to-br from-indigo-500 to-fuchsia-500 text-white grid place-items-center uppercase font-semibold shadow-inner">
                                    {{ Str::substr(optional(Auth::user())->name ?? 'U', 0, 2) }}
                                </span>
                                <span class="text-left">
                                    <span class="block text-sm font-semibold">{{ optional(Auth::user())->name ?? 'Utilisateur' }}</span>
                                    <span class="block text-xs text-indigo-500">{{ optional(Auth::user())->role ?? 'Opticien' }}</span>
                                </span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400 transition" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 10.938l3.71-3.71a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                                </svg>
                            </button>

                            <div x-show="open" x-cloak x-transition
                                 class="absolute right-0 mt-2 w-full max-w-xs rounded-3xl border border-slate-200 bg-white py-2 shadow-xl shadow-indigo-950/10">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-3 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-700 rounded-2xl mx-1">
                                    Mon profil
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-3 text-sm text-slate-700 hover:bg-red-50 hover:text-red-600 rounded-2xl mx-1">
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto bg-slate-50">
                <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
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
@stack('scripts')

</body>
</html>