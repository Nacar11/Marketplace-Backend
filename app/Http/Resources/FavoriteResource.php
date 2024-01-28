<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FavoriteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'product_item_id' => $this->product_item_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'product_item' => new ProductItemResource($this->whenLoaded('productItem')),
            
        ];
    }
}