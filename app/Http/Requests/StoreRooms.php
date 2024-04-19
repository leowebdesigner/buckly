<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRooms extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'name' => ['required'],
            'description' => ['required'],
            'hotel_id' => ['required'],
        ];
    }

    public function messages(): array
{
    return [
        'name.required' => 'O campo nome é obrigatório.',
        'description.required' => 'O campo descrição é obrigatório.',
        'hotel_id.required' => 'O campo hotel é obrigatório.',
    ];
}
}
