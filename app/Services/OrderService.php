<?php

namespace App\Services;


class OrderService implements OrderServiceInterface
{


    public function totalPrice(array $items): float
    {
        $totalPrice = 0;

        foreach ($items as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
            $totalPrice = ($totalPrice * 100)/100;
        }


        return $totalPrice;
    }

    public function checkout(array $items, string $test): array
    {
        $totalPrice = $this->totalPrice($items);

        $chekout = [
            'checkoutPrice' => $totalPrice,
            'checkoutCurrency' => $test
        ];

        return $chekout;
    }
}
