<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

     // true karna tidak perlu role
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
             'name' => ['required', 'string', 'max:225'],
            'phone_number' => ['required', 'string'],
            'proof' => ['required', 'image', 'mimes:png, jpg, jpeg'],
            'notes' => ['required', 'string', 'max:65535'],
        ];
    }
}