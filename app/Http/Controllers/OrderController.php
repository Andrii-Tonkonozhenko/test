<?php

namespace App\Http\Controllers;

use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public $orderService;

    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index()
    {
       //
    }

    public function store(Request $request)
    {
       $chekout = $this->orderService->checkout($request->items, $request->checkoutCurrency);

        return response()->json($request->all());
    }
}
