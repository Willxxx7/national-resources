<?php

namespace App\DataTransferObjects;

final readonly class OrderDTO
{
    private function __construct(private string|int $customerId, private string $orderDate, private string|null $orderNote)
    {
    }

    public static function from(string|int $customerId, string|null $orderNote): OrderDTO
    {
        return new OrderDTO(customerId: (int)$customerId, orderDate: now()->toDateString(), orderNote: $orderNote);
    }

    public function customerId(): int
    {
        return $this->customerId;
    }

    public function orderDate(): string
    {
        return $this->orderDate;
    }

    public function orderNote(): string|null
    {
        return $this->orderNote;
    }
}
