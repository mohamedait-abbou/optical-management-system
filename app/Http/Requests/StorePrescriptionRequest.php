<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id'     => 'required|exists:customers,id',
            'doctor_name'     => 'nullable|string|max:150',

            'right_sphere'    => 'nullable|numeric|between:-30,30',
            'right_cylinder'  => 'nullable|numeric|between:-10,10',
            'right_axis'      => 'nullable|integer|between:0,180',

            'left_sphere'     => 'nullable|numeric|between:-30,30',
            'left_cylinder'   => 'nullable|numeric|between:-10,10',
            'left_axis'       => 'nullable|integer|between:0,180',

            'pd'              => 'nullable|numeric|between:40,80',
            'addition'        => 'nullable|numeric|between:0,5',

            'notes'           => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Veuillez sélectionner un client.',
            'customer_id.exists'   => 'Le client sélectionné est invalide.',
            'right_axis.between'   => 'L\'axe doit être compris entre 0 et 180.',
            'left_axis.between'    => 'L\'axe doit être compris entre 0 et 180.',
            'pd.between'           => 'La distance pupillaire doit être réaliste (entre 40 et 80 mm).',
        ];
    }
}