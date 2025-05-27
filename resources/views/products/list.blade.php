@extends('layouts.app')

@section('content')
<h1>Products List</h1>

<x-link-button href="{{ route('products.create') }}" class="mb-3">Add New Product</x-link-button>



<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Price (IDR)</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @forelse($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->description }}</td>
            <td>{{ number_format($product->price, 0, ',', '.') }}</td>
            <td>
                <x-link-button href="{{ route('products.show', $product->id) }}" class="btn-info btn-sm">Show</x-link-button>
                <x-link-button href="{{ route('products.edit', $product->id) }}" class="btn-warning btn-sm">Edit</x-link-button>

                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    <x-button type="submit" class="btn-danger btn-sm">Delete</x-button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center">No products found.</td></tr>
    @endforelse
    </tbody>
</table>
@endsection
