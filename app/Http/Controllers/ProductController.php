<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Fungsi untuk menampilkan halaman home dengan 6 produk acak
    public function home()
    {
        $products = Product::inRandomOrder()->limit(6)->get();
        return view('home', compact('products'));
    }

    // Fungsi untuk menampilkan daftar produk dengan fitur pencarian, filter, dan sort
    public function index(Request $request)
    {
        // Ambil data produk beserta relasi kategori
        $query = Product::with('category');

        // Jika ada pencarian nama atau deskripsi
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('description', 'like', "%{$request->search}%");
            });
        }

        // Jika ada filter harga minimum
        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        // Jika ada filter harga maksimum
        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        // Jika ada filter kategori produk
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Sorting berdasarkan nama atau harga dan arah urutan (ASC/DESC)
        $sortBy = $request->get('sort_by', 'name');
        $sortOrder = $request->get('sort_order', 'asc');
        if (in_array($sortBy, ['name', 'price']) && in_array($sortOrder, ['asc', 'desc'])) {
            $query->orderBy($sortBy, $sortOrder);
        }

        // Paginasi hasilnya 20 produk per halaman
        $products = $query->paginate(20);

        // Ambil semua kategori untuk dropdown filter
        $categories = Category::all();

        // Tampilkan ke view list
        return view('products.list', compact('products', 'categories'));
    }

    // Fungsi untuk menampilkan form tambah produk
    public function create()
    {
        $categories = Category::all(); // Ambil semua kategori untuk dropdown
        return view('products.create', compact('categories'));
    }

    // Fungsi untuk menyimpan produk baru ke database
    public function store(Request $request)
    {
        // Validasi input form
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Simpan produk baru
        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product berhasil ditambahkan.');
    }

    // Fungsi untuk menampilkan detail produk berdasarkan ID
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Fungsi untuk menampilkan form edit produk
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Fungsi untuk mengupdate data produk berdasarkan ID
    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Cari produk dan update datanya
        $product = Product::findOrFail($id);
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product berhasil diperbarui.');
    }

    // Fungsi untuk menghapus produk berdasarkan ID
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product berhasil dihapus.');
    }
}
