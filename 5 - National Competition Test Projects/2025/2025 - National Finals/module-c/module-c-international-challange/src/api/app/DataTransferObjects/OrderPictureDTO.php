<?php

namespace App\DataTransferObjects;

use App\Helpers\ModelResolver;
use App\Models\Order;

final readonly class OrderPictureDTO
{
    private function __construct(private Order $order, private int $picId, private int $picSizeId, private int $picQty)
    {
    }

    public static function from(Order|string|int $order, string|int $picId, string|int $picSizeId, int $picQty): OrderPictureDTO
    {
        $order = ModelResolver::resolve($order, Order::class);
        return new OrderPictureDTO(order: $order, picId: (int)$picId, picSizeId: (int)$picSizeId, picQty: $picQty);
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function picId(): int
    {
        return $this->picId;
    }

    public function picSizeId(): int
    {
        return $this->picSizeId;
    }

    public function picQty(): int
    {
        return $this->picQty;
    }
}
