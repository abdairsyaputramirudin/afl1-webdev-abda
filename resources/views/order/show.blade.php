
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pesanan</h1>

    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Total:</strong> Rp{{ number_format($order->total, 0, ',', '.') }}</p>
    <p><strong>Alamat Pengiriman:</strong> {{ $order->address }}</p>
    <p><strong>Metode Pembayaran:</strong> {{ ucfirst($order->payment_method) }}</p>

    <h3>Daftar Item</h3>
    <ul>
        @foreach ($order->items as $item)
        <li>{{ $item->product->name }} - {{ $item->quantity }} x Rp{{ number_format($item->price, 0, ',', '.') }}</li>
        @endforeach
    </ul>

    <a href="{{ route('home') }}" class="btn btn-primary">Kembali ke Home</a>
</div>
@endsection
