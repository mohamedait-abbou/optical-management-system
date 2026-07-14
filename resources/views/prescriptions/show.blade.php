@extends('layouts.crm')

@section('page-title', "Détails de l'ordonnance")

@section('content')

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">Ordonnance</p>
            <h2 class="text-3xl font-semibold text-slate-900">Détails de la prescription</h2>
            <p class="mt-2 text-sm text-slate-500">Vue détaillée pour cette ordonnance.</p>
        </div>
        <a href="{{ route('prescriptions.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Retour à la liste</a>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <p class="text-sm font-semibold text-slate-500">Patient</p>
                    <p class="mt-2 text-base font-medium text-slate-900">{{ optional($prescription->customer)->first_name }} {{ optional($prescription->customer)->last_name }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500">Médecin</p>
                    <p class="mt-2 text-base font-medium text-slate-900">{{ $prescription->doctor_name }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500">Date</p>
                    <p class="mt-2 text-base font-medium text-slate-900">{{ optional($prescription->prescription_date)->format('d/m/Y') }}</p>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-500">Notes</p>
                    <p class="mt-2 text-base text-slate-700">{{ $prescription->notes ?? 'Aucune note' }}</p>
                </div>
            </div>

            <div class="mt-8 rounded-3xl bg-slate-50 p-6">
                <h3 class="text-lg font-semibold text-slate-900">Détails de la correction</h3>
                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Oeil droit</p>
                        <div class="mt-4 space-y-3 text-sm text-slate-700">
                            <div>
                                <p class="font-medium">Sphere</p>
                                <p>{{ $prescription->right_sphere ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="font-medium">Cylindre</p>
                                <p>{{ $prescription->right_cylinder ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="font-medium">Axe</p>
                                <p>{{ $prescription->right_axis ?? '—' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-4">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Oeil gauche</p>
                        <div class="mt-4 space-y-3 text-sm text-slate-700">
                            <div>
                                <p class="font-medium">Sphere</p>
                                <p>{{ $prescription->left_sphere ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="font-medium">Cylindre</p>
                                <p>{{ $prescription->left_cylinder ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="font-medium">Axe</p>
                                <p>{{ $prescription->left_axis ?? '—' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl border border-slate-200 bg-white p-4">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Distance pupillaire</p>
                        <p class="mt-3 text-base font-medium text-slate-900">{{ $prescription->pd ? $prescription->pd . ' mm' : '—' }}</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-4">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Addition</p>
                        <p class="mt-3 text-base font-medium text-slate-900">{{ $prescription->addition ?? '—' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-3 rounded-3xl bg-brand-50 p-4">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-700">Actions rapides</p>
                <a href="{{ route('prescriptions.edit', $prescription) }}" class="inline-flex w-full items-center justify-center rounded-2xl bg-brand-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-brand-700">Modifier</a>
                <form action="{{ route('prescriptions.destroy', $prescription) }}" method="POST" onsubmit="return confirm('Supprimer cette ordonnance ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 transition hover:bg-rose-100">Supprimer</button>
                </form>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4 text-sm text-slate-600">
                <p class="font-semibold">Conseil :</p>
                <p class="mt-2">Utilisez l’édition pour ajuster les valeurs si le patient apporte une ordonnance mise à jour.</p>
            </div>
        </div>
    </div>
</div>

@endsection