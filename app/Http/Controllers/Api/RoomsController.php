<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreRooms;
use App\Http\Resources\RoomsResource;
use App\Repositories\RoomsRepository;

class RoomsController extends Controller
{

    protected $repository;

    public function __construct(RoomsRepository $roomsRepository)
    {
        $this->repository = $roomsRepository;
    }

    public function index()
    {   
        return RoomsResource::collection($this->repository->getAllRooms());
    }

    public function show($id)
    {
        return new RoomsResource($this->repository->getRoomsById($id));
    }

    public function create(StoreRooms $request)
    {   
        $rooms = $this->repository->createRooms($request->validated());
        return $rooms;
    }

    public function update(Request $request, $id)
    {   
        try {
            $rooms = $this->repository->getRoomsById($id);
    
            if (!$rooms) {
                return response()->json(['success' => false, 'message' => 'Room não encontrada'], 404);
            }
    
            $fieldsToUpdate = $request->only(array_keys($request->all()));
            $updateResult = $this->repository->updateRooms($fieldsToUpdate, $rooms);
            
            return $updateResult;
    
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar hotel: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Falha ao atualizar Room'], 500);
        }
    }

    public function delete($id)
    {   
        $rooms = $this->repository->deleteRooms($id);
        return $rooms;
    }
}
