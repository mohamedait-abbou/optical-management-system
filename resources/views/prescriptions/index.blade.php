@extends('layouts.crm')

@section('page-title', 'Prescriptions')

@section('content')

<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-indigo-600">Médical</p>
            <h2 class="text-3xl font-semibold text-slate-900">Liste des prescriptions</h2>
        </div>
        @can('prescriptions.create')
        <a href="{{ route('prescriptions.create') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-indigo-500/30 transition hover:bg-indigo-700 hover:scale-[1.02]">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 5v14M5 12h14"/>
            </svg>
            Ajouter une ordonnance
        </a>
        @endcan
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-sm font-medium text-emerald-800 shadow-sm flex items-center gap-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-emerald-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Search & Filters -->
    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="GET" action="{{ route('prescriptions.index') }}" class="flex flex-col gap-4 sm:flex-row sm:items-end">
            <div class="relative flex-1 min-w-0">
                <label for="search" class="block text-sm font-medium text-slate-700 mb-1">Recherche</label>
                <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-4 top-[38px] h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 103.908 9.338l3.587 3.586a1 1 0 001.415-1.414l-3.586-3.587A5.5 5.5 0 009 3.5zm-3.5 5.5a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd" />
                </svg>
                <input id="search" name="search" type="search" value="{{ $search ?? '' }}" placeholder="Rechercher par client ou médecin..." class="w-full rounded-xl border border-slate-200 bg-slate-50 py-3 pl-11 pr-4 text-sm text-slate-700 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition" />
            </div>
            <div class="flex gap-3">
                <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-indigo-500/20 transition hover:bg-indigo-700">
                    Rechercher
                </button>
                @if(!empty($search))
                    <a href="{{ route('prescriptions.index') }}" class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Réinitialiser
                    </a>
                @endif
            </div>
        </form>

        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-sm text-slate-500 border-t border-slate-100 pt-4">
            <p>{{ $prescriptions->total() }} ordonnance{{ $prescriptions->total() > 1 ? 's' : '' }} trouvée{{ $prescriptions->total() > 1 ? 's' : '' }}</p>
            @if(!empty($search))
                <p class="text-slate-400">Résultats pour « {{ $search }} »</p>
            @endif
        </div>
    </div>

    <!-- Content -->
    @if($prescriptions->isEmpty())
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm">
            <div class="mx-auto flex max-w-xl flex-col items-center gap-4">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-indigo-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-slate-900">Aucune ordonnance trouvée</h3>
                    <p class="mt-2 text-sm text-slate-500">Ajoutez une nouvelle ordonnance pour commencer à gérer l'historique médical de vos clients.</p>
                </div>
                @can('prescriptions.create')
                <a href="{{ route('prescriptions.create') }}" class="mt-2 inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14"/></svg>
                    Ajouter une ordonnance
                </a>
                @endcan
            </div>
        </div>
    @else
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm text-slate-700">
                    <thead class="border-b bg-slate-50 text-xs font-semibold uppercase tracking-wider text-slate-500">
                        <tr>
                            <th class="px-6 py-4">Client</th>
                            <th class="px-6 py-4">Médecin</th>
                            <th class="px-6 py-4">Date de création</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($prescriptions as $prescription)
                            <tr class="group hover:bg-slate-50/80 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-900">
                                        {{ optional($prescription->customer)->first_name }} {{ optional($prescription->customer)->last_name }}
                                    </div>
                                    @if(optional($prescription->customer)->phone)
                                        <div class="text-xs text-slate-500 mt-0.5">{{ $prescription->customer->phone }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                                        {{ $prescription->doctor_name ?? 'Non spécifié' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-600">
                                    {{ optional($prescription->created_at)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2 opacity-80 group-hover:opacity-100 transition-opacity">
                                        <a href="{{ route('prescriptions.show', $prescription) }}" class="p-2 rounded-lg bg-indigo-50 text-indigo-600 hover:bg-indigo-100 transition" title="Voir">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/></svg>
                                        </a>
                                        
                                        @can('prescriptions.edit')
                                        <a href="{{ route('prescriptions.edit', $prescription) }}" class="p-2 rounded-lg bg-amber-50 text-amber-600 hover:bg-amber-100 transition" title="Modifier">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 3a2.85 2.83 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                                        </a>
                                        @endcan

                                        @can('prescriptions.delete')
                                        <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cette ordonnance ?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-100 transition" title="Supprimer">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $prescriptions->links() }}
        </div>
    @endif
</div>

@endsection