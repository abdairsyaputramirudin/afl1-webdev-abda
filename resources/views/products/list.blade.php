@extends('layouts.app') 

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Produk</h1>

    {{-- Form pencarian dan filter --}}
    <form method="GET" action="{{ route('products.index') }}" class="row g-2 mb-4">
        {{-- Search nama atau deskripsi --}}
        <div class="col-md-3">
            <input type="text" name="search" class="form-control" placeholder="Cari nama atau deskripsi" value="{{ request('search') }}">
        </div>

        {{-- Filter harga minimum --}}
        <div class="col-md-2">
            <input type="number" name="min_price" class="form-control" placeholder="Harga minimum" value="{{ request('min_price') }}">
        </div>

        {{-- Filter harga maksimum --}}
        <div class="col-md-2">
            <input type="number" name="max_price" class="form-control" placeholder="Harga maksimum" value="{{ request('max_price') }}">
        </div>

        {{-- Filter berdasarkan kategori --}}
        <div class="col-md-2">
            <select name="category_id" class="form-select">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $category)
                    {{-- Opsi akan terpilih jika sesuai dengan input sebelumnya --}}
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Sort by nama atau harga --}}
        <div class="col-md-2">
            <select name="sort_by" class="form-select">
                <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nama</option>
                <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>Harga</option>
            </select>
        </div>

        {{-- Urutan asc/desc --}}
        <div class="col-md-1">
            <select name="sort_order" class="form-select">
                <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>ASC</option>
                <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>DESC</option>
            </select>
        </div>

        {{-- Tombol apply filter & tombol tambah produk --}}
        <div class="col-md-12 mt-2">
            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
            <x-link-button href="{{ route('products.create') }}" class="float-end btn-success">Add New Product</x-link-button>
        </div>
    </form>

    {{-- Menampilkan produk dalam bentuk kartu --}}
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <p class="card-text"><strong>Harga:</strong> Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        <p class="card-text"><strong>Kategori:</strong> {{ $product->category->name ?? '-' }}</p>

                        {{-- Tombol detail, edit, dan delete --}}
                        <x-link-button href="{{ route('products.show', $product->id) }}" class="btn-sm btn-primary">Detail</x-link-button>
                        <x-link-button href="{{ route('products.edit', $product->id) }}" class="btn-sm btn-warning">Edit</x-link-button>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus produk ini?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Navigasi pagination --}}
    <div class="mt-4">
        {!! $products->withQueryString()->links('pagination::bootstrap-5') !!}
    </div>

</div>
@endsection
