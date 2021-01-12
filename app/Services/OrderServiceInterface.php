<?php

namespace App\Services;

interface OrderServiceInterface
{
    public function totalPrice(array $items): float;

    public function checkout(array $items, string $test) : array;
}
