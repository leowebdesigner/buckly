<?php

namespace App\Services;

use GuzzleHttp\Client;

class ViaCepService
{
    public function getAddressDetails($cep)
    {
        $client = new Client();
        $response = $client->get("https://viacep.com.br/ws/{$cep}/json");
        $data = json_decode($response->getBody(), true);

        $address = isset($data['logradouro']) ? $data['logradouro'] : null;
        $city = isset($data['localidade']) ? $data['localidade'] : null;
        $uf = isset($data['uf']) ? $data['uf'] : null;
   
        return [
            'address' => $address,
            'city' => $city,
            'state' => $uf,
            'zip_code' => $data['cep'] ?? null,
        ];
    }
}
