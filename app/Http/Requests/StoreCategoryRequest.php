<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasAnyRole(['owner']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    //  data apa saja yang di berikan user yang di input menuju data base category
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:225'],
            'icon' => ['required', 'image', 'mimes:png, jpg, jpeg'],

        ];
    }
}