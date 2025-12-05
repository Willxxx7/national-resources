<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderPictureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'picture' => PictureResource::make($this->picture),
            'picSize' => PictureSizeResource::make($this->pictureSize),
            'picQty' => $this->pic_qty
        ];
    }
}
