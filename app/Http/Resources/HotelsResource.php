<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HotelsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
              'id' => $this->id,
              'Nome do Hotel' => $this->name,
              'Endereço' => $this->address,
              'Cidade' => $this->city,
              'Estado' => $this->state,
              'Cep' => $this->zip_code,
              'Website' => $this->website,
              'Quartos' => RoomsResource::collection($this->whenLoaded('rooms')),

        ];
    }
}
