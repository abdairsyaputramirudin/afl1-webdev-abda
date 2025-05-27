@extends('layouts.app')

@section('content')
<h1>Edit Product</h1>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $product->description) }}</textarea>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="price" class="form-label">Price (IDR)</label>
        <input type="number" name="price" id="price" class="form-control" step="0.01" value="{{ old('price', $product->price) }}" required min="0">
        @error('price')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <x-button type="submit" class="btn-primary">Update Product</x-button>
    <x-link-button href="{{ route('products.index') }}">Cancel</x-link-button>
</form>
@endsection
