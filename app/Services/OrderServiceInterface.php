<?php

namespace App\Services;

interface OrderServiceInterface
{
    public function totalPrice(array $items, string $currency): float;

    public function convertCurrency(float $amount, string $from, string $to) : float;

    public function checkout(array $items, string $currency) : array;
}
