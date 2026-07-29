<x-mail::message>
# {{ $subjectText }}

{{ $messageContent }}

<x-mail::button :url="route('customers.show', $customer)">
Voir mon profil
</x-mail::button>

Cordialement,<br>
**Optical CRM**
</x-mail::message>