<?php

namespace App\Repositories;

use App\Models\Hotels;
use Illuminate\Support\Facades\Log;

class HotelsRepository
{
    protected $entity;

    public function __construct(Hotels $model)
    {
       $this->entity = $model;
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
            $hotel = $this->entity->create([
                'name' => $data['name'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'zip_code' => $data['zip_code'],
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