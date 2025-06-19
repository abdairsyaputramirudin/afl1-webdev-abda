<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;        
use App\Models\OrderItem;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Fungsi untuk menambahkan produk ke keranjang
    public function add($productId)
    {
        $user = Auth::user();
        $product = Product::findOrFail($productId);

        $cart = Cart::firstOrCreate(
            ['user_id' => $user->id, 'product_id' => $product->id],
            ['quantity' => 0]
        );

        $cart->increment('quantity', 1);

        return redirect()->route('cart.index');
    }

    // Fungsi untuk menampilkan keranjang
    public function index()
    {
        $user = Auth::user();
        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        $total = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    // Fungsi untuk mengupdate jumlah produk dalam keranjang
    public function update(Request $request, $cartId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = Cart::findOrFail($cartId);

        // Update quantity produk di keranjang
        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index');
    }

    // Fungsi untuk menghapus produk dari keranjang
    public function remove($cartId)
    {
        $cartItem = Cart::findOrFail($cartId);
        $cartItem->delete();

        return redirect()->route('cart.index');
    }

    // Fungsi untuk checkout
    public function checkout()
    {
        $cartItems = Cart::where('user_id', Auth::id())->get();
        $total = $cartItems->sum(function ($cartItem) {
            return $cartItem->product->price * $cartItem->quantity;
        });

        return view('checkout.index', compact('cartItems', 'total'));
    }

    // Proses checkout dan pembelian
    public function processCheckout(Request $request)
    {
        $order = Order::create([ 
            'user_id' => Auth::id(),
            'address' => $request->address,
            'payment_method' => $request->payment_method,
            'total' => $request->total,
        ]);

        foreach (Cart::where('user_id', Auth::id())->get() as $cartItem) {
            OrderItem::create([ 
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);
            $cartItem->delete(); 
        }

        return redirect()->route('order.show', $order->id); 
    }
}
