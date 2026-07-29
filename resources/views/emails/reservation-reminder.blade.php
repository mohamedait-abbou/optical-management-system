<x-mail::message>
# Bonjour {{ $reservation->customer->first_name }} 👋,

Nous vous rappelons que vous avez un rendez-vous chez **Optical CRM** demain.

<x-mail::panel>
**Détails du rendez-vous :**

- **Date :** {{ $reservation->reservation_date->format('d/m/Y') }}
- **Heure :** {{ $reservation->reservation_time }}
- **Motif :** {{ $reservation->reason ?? 'Consultation' }}
</x-mail::panel>

<x-mail::button :url="route('reservations.show', $reservation)">
Voir mon rendez-vous
</x-mail::button>

Pour toute annulation ou modification, veuillez nous contacter au plus vite.

Nos horaires d'ouverture : **Lun-Sam, 9h-19h**.

Cordialement,<br>
**{{ config('app.name') }}**
</x-mail::message>
