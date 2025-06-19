@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="text-center mb-5">
        <h1 class="display-4">Selamat Datang</h1>
        <p class="lead">Halaman untuk memantau produk-produk di gudang kami.</p>
        <a href="{{ route('products.index') }}" class="btn btn-lg btn-primary mt-3">Lihat Produk</a>
    </div>

    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>

                        @auth
                            <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success">Add to Cart</button>
                            </form>
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-sm btn-outline-secondary">Login untuk Add to Cart</a>
                        @endguest
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
