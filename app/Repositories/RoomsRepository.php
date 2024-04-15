<?php

namespace App\Repositories;

use App\Models\Rooms;
use Illuminate\Support\Facades\Log;

class RoomsRepository
{
    protected $entity;

    public function __construct(Rooms $model)
    {
       $this->entity = $model;
    }

    public function getAllRoomsOfHotels($hotelId)
    {
       return $this->entity
                   ->where('hotel_id', $hotelId)
                   ->get();
    }

    public function getRoomsById($identify)
    {
       return $this->entity->findOrFail($identify);
    }

    public function createRooms(array $data)
    {
        try {
            $this->entity->create([
                'name' => $data['name'],
                'description' => $data['description'],
                'hotel_id' => $data['hotel_id'],
            ]);

            return ['success' => true, 'message' => 'Room criada com sucesso'];

        } catch (\Exception $e) {
            Log::error('Erro ao criar room: ' . $e->getMessage());

            return ['success' => false, 'message' => 'Falha ao criar room'];
        }
    }

    public function updateRooms(array $data, Rooms $room)
    {
        try {
            $room->update($data);
    
            return response()->json(['success' => true, 'message' => 'Room atualizada com sucesso']);
    
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar room: ' . $e->getMessage());
    
            return response()->json(['success' => false, 'message' => 'Falha ao atualizar room'], 500);
        }
    }

    public function deleteRooms($identify)
    {
        try {
            $room = $this->entity->findOrFail($identify);
            $room->delete();

            return ['success' => true, 'message' => 'Room excluída com sucesso'];

        } catch (\Exception $e) {
            Log::error('Erro ao excluir Room: ' . $e->getMessage());

            return ['success' => false, 'message' => 'Falha ao excluir Room'];
        }
    }
}