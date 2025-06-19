<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Menampilkan detail pesanan berdasarkan ID order
    public function show($orderId)
    {
        $order = Order::with('items.product')->findOrFail($orderId); 
        return view('order.show', compact('order')); 
    }
}