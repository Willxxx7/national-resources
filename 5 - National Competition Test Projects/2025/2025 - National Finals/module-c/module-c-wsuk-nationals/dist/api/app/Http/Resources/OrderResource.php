<?php

namespace App\Http\Resources;

use App\Models\OrderPicture;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // calculate total

        $orderTotal = 0;

        /**
         * @var OrderPicture $orderPicture
         */
        foreach ($this->orderPictures as $orderPicture) {
            $orderTotal += $orderPicture->pic_qty * $orderPicture->pictureSize->pic_size_price;
        }

        return [
            'orderId' => $this->order_id,
            'orderDate' => $this->order_date,
            'orderStatus' => $this->order_status,
            'orderNote' => $this->when(!is_null($this->order_note), $this->order_note),
            'customer' => CustomerResource::make($this->whenLoaded('customer')),
            'orderPictures' => OrderPictureResource::collection($this->orderPictures),
            'orderTotal' => number_format($orderTotal, 2)
        ];
    }
}
