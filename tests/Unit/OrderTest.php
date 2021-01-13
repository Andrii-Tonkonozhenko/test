<?php

namespace Tests\Unit;

use App\Services\OrderService;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function test_convertCurrencyFunction()
    {
        $from = 'EUR';
        $to = 'RUB';
        $amount = 100;
        $rates = [
            'USD' => 1,
            'EUR' => 0.819455,
            'RUB' => 73.5885,
            ];

        if ($from != 'USD' || $to != 'USD') {
            $convertedValue = ($amount / $rates[$from]) * $rates[$to];
        } else {
            $convertedValue = $amount * $rates[$to];
        }

        $this->assertEquals(8980.18, round($convertedValue, 2));
    }

    public function test_totalPrice_function()
    {
        $items = [
            'item' => [
                'currency' => "USD",
                'price' => 5,
                'quantity' => 2,
            ]
        ];
        $totalPrice = (new OrderService())->totalPrice($items, 'USD');
        $this->assertEquals(10, $totalPrice);
    }
}
