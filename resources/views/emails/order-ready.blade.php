<x-mail::message>
# Bonjour {{ $order->customer->first_name }} 👋,

Bonne nouvelle ! Votre commande **#{{ $order->order_number }}** est prête à être récupérée en magasin.

<x-mail::panel>
**Récapitulatif :**

- **Numéro de commande :** #{{ $order->order_number }}
- **Date de commande :** {{ $order->order_date->format('d/m/Y') }}
- **Montant total :** {{ number_format($order->total_amount, 2, ',', ' ') }} DH
- **Statut :** Prête
</x-mail::panel>

<x-mail::button :url="route('orders.show', $order)">
Voir ma commande
</x-mail::button>

Nos horaires d'ouverture : **Lun-Sam, 9h-19h**.
À très bientôt ! 🎉

Cordialement,<br>
**{{ config('app.name') }}**
</x-mail::message>
