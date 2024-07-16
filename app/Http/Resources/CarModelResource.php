<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarModelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return   [
            'id' =>  $this->id,
            'name' =>   $this->name,
            'brand_id' =>   $this->brand_id,
            'fuel_id' =>   $this->fuel_id,
            'category_id' =>    $this->category_id,
        ];
    }
}
