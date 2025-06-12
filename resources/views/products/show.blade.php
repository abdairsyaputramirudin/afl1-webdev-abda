@extends('layouts.app')

@section('content')
<h1>Product Detail</h1>

{{-- Tabel detail produk --}}
<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <td>{{ $product->name }}</td> {{-- Nama produk --}}
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $product->description }}</td> {{-- Deskripsi produk --}}
    </tr>
    <tr>
        <th>Price (IDR)</th>
        <td>{{ number_format($product->price, 2, ',', '.') }}</td> {{-- Harga dengan format 2 digit desimal --}}
    </tr>
</table>

{{-- Tombol kembali dan edit --}}
<x-link-button href="{{ route('products.index') }}">Back to List</x-link-button>
<x-link-button href="{{ route('products.edit', $product->id) }}" class="btn-warning">Edit Product</x-link-button>
@endsection
