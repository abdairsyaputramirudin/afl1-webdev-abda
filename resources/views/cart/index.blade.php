@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Keranjang Belanja</h1>

    @if($cartItems->isEmpty())
        <p>Keranjang Anda kosong.</p>
    @else
        <div class="row mb-3">
            <div class="col-md-4"><strong>Nama Produk</strong></div>
            <div class="col-md-2"><strong>Harga Satuan</strong></div>
            <div class="col-md-2"><strong>Jumlah</strong></div>
            <div class="col-md-2"><strong>Subtotal</strong></div>
            <div class="col-md-2"><strong>Aksi</strong></div>
        </div>

        @foreach($cartItems as $cartItem)
        <div class="row mb-3">
            <div class="col-md-4">
                <strong>{{ $cartItem->product->name }}</strong>
            </div>
            <div class="col-md-2">
           
                Rp{{ number_format($cartItem->product->price, 0, ',', '.') }}
            </div>
            <div class="col-md-2">
           
                <form action="{{ route('cart.update', $cartItem->id) }}" method="POST">
                    @csrf
                    <input type="number" name="quantity" id="quantity_{{ $cartItem->id }}" value="{{ $cartItem->quantity }}" min="1" class="form-control" required>
                    <button type="submit" class="btn btn-warning mt-2">Update</button>
                </form>
            </div>
            <div class="col-md-2">
             
                Rp{{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }}
            </div>
            <div class="col-md-2">
     
                <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </div>
        </div>
        @endforeach

        <hr>

        <h4>Total Keranjang: Rp{{ number_format($total, 0, ',', '.') }}</h4>
        @if(!$cartItems->isEmpty())
            <a href="{{ route('checkout.index') }}" class="btn btn-primary">Checkout</a>
        @else
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali ke Produk</a>
        @endif
    @endif
</div>
@endsection
