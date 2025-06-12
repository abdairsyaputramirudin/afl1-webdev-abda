@extends('layouts.app') 

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Produk</h1>

    {{-- Form untuk update data produk --}}
    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf

        {{-- Input nama produk, nilai awal diisi dari data produk --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        {{-- Input deskripsi produk --}}
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ $product->description }}</textarea>
        </div>

        {{-- Input harga produk --}}
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $product->price }}" required>
        </div>

        {{-- Dropdown kategori dengan kategori aktif otomatis terpilih --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-select" name="category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    {{-- Tandai sebagai terpilih jika cocok dengan category_id produk --}}
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol update dan batal pakai komponen --}}
        <x-button type="submit">Update</x-button>
        <x-link-button href="{{ route('products.index') }}" class="btn-secondary">Batal</x-link-button>
    </form>
</div>
@endsection
