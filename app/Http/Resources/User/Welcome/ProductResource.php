<?php

namespace App\Http\Resources\User\Welcome;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "brand" => $this->brand->name,
            "final_price" => $this->final_price,
            "likes" => $this->likes,
            "discount" => $this->discount,
            "discount_percent" => $this->discount_percent,
            "color" => $this->color->name,
            "main_image" => $this->main_image,
            'liked' => $this->when(auth()->check(), function () {
                return $this->likes()->where(['user_id' => auth()->user()->id], ['product_id' => $this->id])->exists() ? true : false;
            }),
        ];
    }
}
