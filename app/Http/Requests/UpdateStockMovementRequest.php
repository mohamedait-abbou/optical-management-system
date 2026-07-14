<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStockMovementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules.
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'type'       => ['required', 'in:IN,OUT'],
            'quantity'   => ['required', 'integer', 'min:1'],
            'reference'  => ['nullable', 'string', 'max:255'],
            'notes'      => ['nullable', 'string'],
        ];
    }

    /**
     * Custom validation messages.
     */
    public function messages(): array
    {
        return [
            'product_id.required' => 'Le produit est obligatoire.',
            'product_id.exists'   => 'Le produit sélectionné est invalide.',

            'type.required'       => 'Le type de mouvement est obligatoire.',
            'type.in'             => 'Le type doit être IN ou OUT.',

            'quantity.required'   => 'La quantité est obligatoire.',
            'quantity.integer'    => 'La quantité doit être un nombre.',
            'quantity.min'        => 'La quantité doit être supérieure à zéro.',
        ];
    }
}