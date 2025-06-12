@extends('layouts.app')

@section('content')
<div class="container py-5">

    {{-- Bagian hero / sambutan halaman --}}
    <div class="text-center mb-5">
        <h1 class="display-4">Selamat Datang</h1>
        <p class="lead">Halaman untuk memantau produk-produk di gudang kami.</p>
        {{-- Tombol untuk masuk ke halaman daftar produk --}}
        <a href="{{ route('products.index') }}" class="btn btn-lg btn-primary mt-3">Lihat Produk</a>
    </div>

    {{-- Menampilkan beberapa produk acak sebagai preview --}}
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-outline-primary">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
