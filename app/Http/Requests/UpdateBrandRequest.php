<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
   public function authorize(): bool
{
    return true;
}

public function rules(): array
{
    return [

        'name'=>'required|max:255',

        'country'=>'nullable|max:255',

        'logo'=>'nullable|max:255',

        'description'=>'nullable',

    ];
}
}
