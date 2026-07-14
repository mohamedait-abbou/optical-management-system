@extends('layouts.crm')

@section('page-title', 'Prescriptions')

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Prescriptions</p>
            <h2 class="text-3xl font-semibold text-slate-900">Liste des prescriptions</h2>
            <p class="mt-2 text-sm text-slate-500">Recherchez, visualisez ou modifiez des ordonnances patients.</p>
        </div>
        <a href="{{ route('prescriptions.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Ajouter une ordonnance</a>
    </div>

    @if(session('success'))
        <div class="rounded-3xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-700 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid gap-4 xl:grid-cols-[1fr_300px]">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <form method="GET" action="{{ route('prescriptions.index') }}" class="flex flex-col gap-4 sm:flex-row sm:items-center">
                <div class="relative flex-1 min-w-0">
                    <label for="search" class="sr-only">Recherche</label>
                    <svg xmlns="http://www.w3.org/2000/svg" class="pointer-events-none absolute left-4 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 103.908 9.338l3.587 3.586a1 1 0 001.415-1.414l-3.586-3.587A5.5 5.5 0 009 3.5zm-3.5 5.5a3.5 3.5 0 117 0 3.5 3.5 0 01-7 0z" clip-rule="evenodd" />
                    </svg>
                    <x-text-input id="search" name="search" type="search" value="{{ $search ?? '' }}" placeholder="Rechercher par client ou médecin" class="w-full rounded-2xl border-slate-200 bg-slate-100 py-3 pl-11 pr-4 text-sm text-slate-700" />
                </div>
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                    <x-primary-button type="submit">Rechercher</x-primary-button>
                    @if(!empty($search))
                        <a href="{{ route('prescriptions.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Réinitialiser</a>
                    @endif
                </div>
            </form>

            <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-sm text-slate-500">
                <p>{{ $prescriptions->total() }} ordonnance{{ $prescriptions->total() > 1 ? 's' : '' }}</p>
                @if(!empty($search))
                    <p class="text-slate-400">Résultats pour « {{ $search }} »</p>
                @endif
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-brand-50 p-6 text-slate-800 shadow-sm">
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-700">À retenir</p>
            <p class="mt-3 text-sm leading-6 text-slate-700">Utilisez la recherche pour retrouver rapidement une ordonnance par client ou médecin.</p>
            <div class="mt-5 rounded-2xl bg-white p-4 text-sm text-slate-600">
                <p class="font-semibold">Astuce :</p>
                <p class="mt-2">La colonne Actions vous permet de visualiser, modifier ou supprimer chaque ordonnance.</p>
            </div>
        </div>
    </div>

    @if($prescriptions->isEmpty())
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white p-10 text-center shadow-sm">
            <div class="mx-auto flex max-w-xl flex-col items-center gap-4 text-slate-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 3v18" />
                    <path d="M6 7h12" />
                    <path d="M6 11h12" />
                    <path d="M9 16h6" />
                </svg>
                <div>
                    <h3 class="text-xl font-semibold text-slate-900">Aucune ordonnance trouvée</h3>
                    <p class="mt-2 text-sm text-slate-500">Ajoutez une nouvelle ordonnance pour commencer à gérer les prescriptions.</p>
                </div>
                <a href="{{ route('prescriptions.create') }}" class="inline-flex items-center justify-center rounded-2xl bg-brand-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Ajouter une ordonnance</a>
            </div>
        </div>
    @else
        <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
            <table class="min-w-full text-left text-sm text-slate-700">
                <thead class="border-b bg-slate-50 text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Client</th>
                        <th class="px-6 py-4">Médecin</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @foreach($prescriptions as $prescription)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                {{ optional($prescription->customer)->first_name }} {{ optional($prescription->customer)->last_name }}
                            </td>
                            <td class="px-6 py-4">{{ $prescription->doctor_name }}</td>
                            <td class="px-6 py-4">{{ optional($prescription->created_at)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a href="{{ route('prescriptions.show', $prescription) }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-sm font-medium text-brand-700 transition hover:bg-brand-50">Voir</a>
                                    <a href="{{ route('prescriptions.edit', $prescription) }}" class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-sm font-medium text-slate-600 transition hover:bg-slate-100">Modifier</a>
                                    <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" class="inline-block" onsubmit="return confirm('Voulez-vous vraiment supprimer cette ordonnance ?')">
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

@endsection