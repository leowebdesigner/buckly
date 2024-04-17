<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Services\ViaCepService;

class StoreHotels extends FormRequest
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
            'address' => ['required'],
            'city' => ['required'],
            'state' => ['required'],
            'zip_code' => ['required'],
            'website' => ['nullable','max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'address.required' => 'O campo endereço é obrigatório.',
            'city.required' => 'O campo cidade é obrigatório.',
            'state.required' => 'O campo estado é obrigatório.',
            'zip_code.required' => 'O campo CEP é obrigatório.',
        ];
    }

    public function validationData(): array
    {
        $data = parent::validationData();

        if ($this->has('zip_code')) {
            $viaCepService = app(ViaCepService::class);
            $cep = $this->input('zip_code');
            $addressData = $viaCepService->getAddressDetails($cep);
    
            if ($addressData) {
                $data = array_merge($data, [
                    'address' => $addressData['address'],
                    'city' => $addressData['city'],
                    'state' => $addressData['state']
                ]);
            }
        }

        return $data;
    }
}
