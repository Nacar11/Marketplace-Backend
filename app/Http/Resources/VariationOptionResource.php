<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VariationOptionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'value' => $this->value,
            'variation_id' => $this->variation_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];    }
}
