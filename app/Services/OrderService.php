<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class OrderService implements OrderServiceInterface
{
    public function convertCurrency(float $amount, string $from, string $to): float
    {
        $response = Http::get('https://openexchangerates.org/api/latest.json?app_id=c05ee910b0fb4634b6fe80e55ba6c83a');
        $rates = $response['rates'];

        if ($from != 'USD' || $to != 'USD') {
            $convertedValue = ($amount / $rates[$from]) * $rates[$to];
        } else {
            $convertedValue = $amount * $rates[$to];
        }

        return $convertedValue;
    }

    public function totalPrice(array $items, string $currency): float
    {
        $totalPrice = 0;

        foreach ($items as $item) {
            if ($item['currency'] != $currency) {
                $totalPrice += $this->convertCurrency($item['price'], $item['currency'], $currency) * $item['quantity'];
            } else {
                $totalPrice += $item['price'] * $item['quantity'];
            }
        }

        return round($totalPrice, 2);
    }

    public function checkout(array $items, string $currency): array
    {
        $totalPrice = $this->totalPrice($items, $currency);

        $checkout = [
            'checkoutPrice' => $totalPrice,
            'checkoutCurrency' => $currency
        ];

        return $checkout;
    }
}
