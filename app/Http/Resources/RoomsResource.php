<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomsResource extends JsonResource
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
              'Nome do quarto' => $this->name,
              'Descrição do quarto' => $this->description,
              'Pertence ao hotel' => $this->hotel_id,
        ];
    }
}
