<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout dengan informasi produk di keranjang dan total
    public function show()
    {
        // Mengambil data keranjang berdasarkan user yang sedang login
        $cartItems = Cart::where('user_id', Auth::id())->get();

        // Menghitung total harga berdasarkan produk dan kuantitas di keranjang
        $total = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        // Mengembalikan tampilan checkout dan mengirim data keranjang dan total
        return view('checkout.index', compact('cartItems', 'total'));
    }

    // Proses checkout dan pemesanan produk
    public function process(Request $request)
    {
        // Membuat order baru di database
        $order = Order::create([
            'user_id' => Auth::id(), 
            'address' => $request->address, 
            'payment_method' => $request->payment_method, 
            'total' => $request->total, 
        ]);

        // Menambahkan setiap item dalam keranjang ke orderItem yang sesuai
        foreach (Cart::where('user_id', Auth::id())->get() as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id, 
                'product_id' => $cartItem->product_id, 
                'quantity' => $cartItem->quantity, 
                'price' => $cartItem->product->price, 
            ]);
            $cartItem->delete(); 
        }

        // Mengarahkan ke halaman detail order yang baru dibuat
        return redirect()->route('order.show', $order->id); 
    }
}
