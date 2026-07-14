@extends('layouts.crm')

@section('page-title', 'Calendrier des réservations')

@section('content')

<div class="space-y-6">

    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-brand-600">
                Réservations
            </p>

            <h2 class="text-3xl font-semibold text-slate-900">
                Calendrier des rendez-vous
            </h2>

            <p class="mt-2 text-sm text-slate-500">
                Consultez tous les rendez-vous dans un calendrier.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('reservations.index') }}"
               class="rounded-2xl border border-slate-300 bg-white px-5 py-3 font-semibold text-slate-700 hover:bg-slate-50">
                Liste
            </a>

            <a href="{{ route('reservations.create') }}"
               class="rounded-2xl bg-brand-600 px-5 py-3 font-semibold text-white hover:bg-brand-700">
                Nouvelle réservation
            </a>

        </div>

    </div>

    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">

        <div id="calendar"></div>

    </div>

</div>

@endsection

@push('styles')

<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">

<style>

#calendar{

    min-height:750px;

}

.fc-toolbar-title{

    font-size:1.4rem;

    font-weight:700;

}

.fc-button{

    background:#2563eb !important;

    border:none !important;

}

.fc-button:hover{

    background:#1d4ed8 !important;

}

.fc-daygrid-event{

    border-radius:8px;

    padding:2px 4px;

}

</style>

@endpush

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    let calendarEl = document.getElementById('calendar');

    let calendar = new FullCalendar.Calendar(calendarEl, {

        locale: 'fr',

        initialView: 'dayGridMonth',

        height: 750,

        navLinks: true,

        selectable: true,

        nowIndicator: true,

        headerToolbar: {

            left: 'prev,next today',

            center: 'title',

            right: 'dayGridMonth,timeGridWeek,timeGridDay'

        },

        buttonText: {

            today: "Aujourd'hui",

            month: "Mois",

            week: "Semaine",

            day: "Jour"

        },

        events: "{{ route('reservations.events') }}",

        eventClick: function(info){

            info.jsEvent.preventDefault();

            window.location.href = info.event.url;

        }

    });

    calendar.render();

});

</script>

@endpush