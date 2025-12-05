<?php

namespace App\Services;

use App\DataTransferObjects\OrderDTO;
use App\DataTransferObjects\OrderPictureDTO;
use App\Models\Order;
use App\Models\OrderPicture;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class OrderService
{
    /**
     * Creates a new order record/model from an OrderDTO
     * @param OrderDTO $dto
     * @return Order
     */
    public function createOrder(OrderDTO $dto): Order
    {
        return Order::create([
            'cust_id' => $dto->customerId(),
            'order_date' => $dto->orderDate(),
            'order_note' => $dto->orderNote()
        ]);
    }


    /**
     * Creates a collection of OrderPicture records
     * @param Collection<OrderPictureDTO> $orderPictureDTOs
     * @return EloquentCollection<OrderPicture>
     */
    public function createOrderPictures(Collection $orderPictureDTOs): EloquentCollection
    {
        return new EloquentCollection($orderPictureDTOs->map(function (OrderPictureDTO $dto) {
            return $dto->order()->orderPictures()->create([
                'pic_id' => $dto->picId(),
                'pic_size_id' => $dto->picSizeId(),
                'pic_qty' => $dto->picQty()
            ]);
        }));
    }
}
