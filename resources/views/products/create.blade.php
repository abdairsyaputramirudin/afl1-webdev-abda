{{--views/products/create.blade.php --}}
@extends('layouts.app') 

@section('content')
<div class="container">
    <h1 class="mb-4">Tambah Produk</h1>

    {{-- Form untuk menyimpan produk baru --}}
    <form action="{{ route('products.store') }}" method="POST">
        @csrf 

        {{-- Input nama produk --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama Produk</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>

        {{-- Input deskripsi produk --}}
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        {{-- Input harga produk --}}
        <div class="mb-3">
            <label for="price" class="form-label">Harga</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>

        {{-- Dropdown untuk memilih kategori --}}
        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select class="form-select" name="category_id" required>
                <option value="">Pilih Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tombol submit dan batal pakai komponen --}}
        <x-button type="submit">Simpan</x-button>
        <x-link-button href="{{ route('products.index') }}" class="btn-secondary">Batal</x-link-button>
    </form>
</div>
@endsection
