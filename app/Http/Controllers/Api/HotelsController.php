<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreHotels;
use App\Http\Resources\HotelsResource;
use App\Repositories\HotelsRepository;
use App\Http\Traits\ApiResponseTrait;

class HotelsController extends Controller
{
    use ApiResponseTrait;

    protected $repository;

    public function __construct(HotelsRepository $hotelsRepository)
    {
        $this->repository = $hotelsRepository;
    }

    public function index(Request $request)
    {
        $hotels = $this->repository->getAllHotels();
        return $this->respondJsonOrView(HotelsResource::collection($hotels), 'livewire.hotels.index');
    }

    public function show($id)
    {
        return new HotelsResource($this->repository->getHotelsById($id));
    }

    public function create(StoreHotels $request)
    {
        $data = $request->validationData();
        $hotels = $this->repository->createHotels($data);

        return $hotels;
    }

    public function update(Request $request, $id)
    {
        try {
            $hotel = $this->repository->getHotelsById($id);

            if (!$hotel) {
                return response()->json(['success' => false, 'message' => 'Hotel não encontrado'], 404);
            }

            $fieldsToUpdate = $request->only(array_keys($request->all()));
            $updateResult = $this->repository->updateHotels($fieldsToUpdate, $hotel);

            return $updateResult;

        } catch (\Exception $e) {
            Log::error('Erro ao atualizar hotel: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Falha ao atualizar hotel'], 500);
        }
    }

    public function delete($id)
    {
        $hotels = $this->repository->deleteHotels($id);
        return $hotels;
    }
}
