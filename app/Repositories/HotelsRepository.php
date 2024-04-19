<?php

namespace App\Repositories;

use App\Models\Hotels;
use App\Services\ViaCepService;
use Illuminate\Support\Facades\Log;

class HotelsRepository
{
    protected $entity;
    protected $viaCepService;

    public function __construct(Hotels $model, ViaCepService $viaCepService)
    {
       $this->entity = $model;
       $this->viaCepService = $viaCepService;
    }

    public function getAllHotels()
    {
       return $this->entity->with("rooms")->get();
    }

    public function getHotelsById($identify)
    {
       return $this->entity->with("rooms")->findOrFail($identify);
    }

    public function createHotels(array $data)
    {
        try {
            $addressData = $this->viaCepService->getAddressDetails($data['zip_code']);
            $this->entity->create([
                'name' => $data['name'],
                'address' => $addressData['address'],
                'city' => $addressData['city'],
                'state' => $addressData['state'],
                'zip_code' => $addressData['zip_code'],
                'website' => $data['website'],
            ]);

            return ['success' => true, 'message' => 'Hotel criado com sucesso'];

        } catch (\Exception $e) {
            Log::error('Erro ao criar hotel: ' . $e->getMessage());

            return ['success' => false, 'message' => 'Falha ao criar hotel'];
        }
    }

    public function updateHotels(array $data, Hotels $hotel)
    {
        try {
            $hotel->update($data);
    
            return response()->json(['success' => true, 'message' => 'Hotel atualizado com sucesso']);
    
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar hotel: ' . $e->getMessage());
    
            return response()->json(['success' => false, 'message' => 'Falha ao atualizar hotel'], 500);
        }
    }

    public function deleteHotels($identify)
    {
        try {
            $hotel = $this->entity->findOrFail($identify);
            $hotel->delete();

            return ['success' => true, 'message' => 'Hotel excluído com sucesso'];

        } catch (\Exception $e) {
            Log::error('Erro ao excluir hotel: ' . $e->getMessage());

            return ['success' => false, 'message' => 'Falha ao excluir hotel'];
        }
    }
}