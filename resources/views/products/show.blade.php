@extends('layouts.app')

@section('content')
<h1>Product Detail</h1>

<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <td>{{ $product->name }}</td>
    </tr>
    <tr>
        <th>Description</th>
        <td>{{ $product->description }}</td>
    </tr>
    <tr>
        <th>Price (IDR)</th>
        <td>{{ number_format($product->price, 2, ',', '.') }}</td>
    </tr>
</table>

<x-link-button href="{{ route('products.index') }}">Back to List</x-link-button>
<x-link-button href="{{ route('products.edit', $product->id) }}" class="btn-warning">Edit Product</x-link-button>
@endsection
