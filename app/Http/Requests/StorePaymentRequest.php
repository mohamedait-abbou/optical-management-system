<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // On récupère la commande depuis la route pour limiter
        // le montant payé au montant restant réellement dû.
        $order = $this->route('order');
        $maxAmount = $order ? $order->remaining_amount : 999999;

        return [
            'amount'         => "required|numeric|min:0.01|max:{$maxAmount}",
            'payment_date'   => 'required|date|before_or_equal:today',
            'payment_method' => 'required|in:especes,carte,virement,cheque',
            'notes'          => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'amount.required'       => 'Le montant est obligatoire.',
            'amount.max'            => 'Le montant dépasse le reste à payer.',
            'payment_date.required' => 'La date de paiement est obligatoire.',
            'payment_date.before_or_equal' => 'La date ne peut pas être dans le futur.',
            'payment_method.required' => 'La méthode de paiement est obligatoire.',
        ];
    }
}