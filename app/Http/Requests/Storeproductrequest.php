<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'            => 'required|string|max:150',
            'brand_id'        => 'nullable|exists:brands,id',
            'category_id'     => 'required|exists:categories,id',
            'price'           => 'required|numeric|min:0',
            'cost_price'      => 'nullable|numeric|min:0',
            'quantity'        => 'required|integer|min:0',
            'alert_threshold' => 'nullable|integer|min:0',
            'image'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'description'     => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'        => 'Le nom du produit est obligatoire.',
            'category_id.required' => 'La catégorie est obligatoire.',
            'category_id.exists'   => 'La catégorie sélectionnée est invalide.',
            'price.required'       => 'Le prix est obligatoire.',
            'price.numeric'        => 'Le prix doit être un nombre.',
            'quantity.required'    => 'La quantité en stock est obligatoire.',
            'image.image'          => 'Le fichier doit être une image.',
            'image.max'            => 'L\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}