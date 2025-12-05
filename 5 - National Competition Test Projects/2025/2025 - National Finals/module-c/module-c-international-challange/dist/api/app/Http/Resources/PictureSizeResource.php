<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PictureSizeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'picSizeId' => $this->pic_size_id,
            'picSizeLabel' => $this->pic_size_label,
            'picSizeWidth' => (float)$this->pic_size_width,
            'picSizeHeight' => (float)$this->pic_size_height,
            'picSizePrice' => (float)$this->pic_size_price
        ];
    }
}
