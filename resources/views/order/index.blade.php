@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Pembelian</h1>
    @foreach($orders as $order)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Order ID: {{ $order->id }}</h5>
                <p class="card-text">Total: Rp{{ number_format($order->total, 0, ',', '.') }}</p>
                <p class="card-text">Alamat: {{ $order->address }}</p>
                <p class="card-text">Metode Pembayaran: {{ $order->payment_method }}</p>
                <a href="{{ route('order.show', $order->id) }}" class="btn btn-primary">Lihat Detail</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
