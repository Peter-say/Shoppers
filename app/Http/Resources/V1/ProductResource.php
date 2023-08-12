<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'store_id' => $this->store_id,
            'name' => $this->name,
            'amount' => $this->amount,
            'currency_id' => $this->currency_id,
            'discount_price' => $this->discount_price,
            'discount_percent' => $this->discount_percent,
            'images' => $this->images,
            'cover_image' => $this->cover_image,
        ];
    }
}
