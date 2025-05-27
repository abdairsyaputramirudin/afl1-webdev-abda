<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // Menampilkan list produk secara random, max 20 produk 
    public function index()
    {
        $products = Product::inRandomOrder()->limit(20)->get();
        return view('products.list', compact('products'));
    }

    // Menampilkan form tambah produk baru (poin 13, bagian create)
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk baru ke database (poin 14)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Menampilkan form edit produk (poin 7)
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // Mengupdate data produk (poin 9 dan 10) 
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Menampilkan detail produk (poin 10)
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Mendelete  produk (tambahan)
    public function destroy($id)
{
    $product = Product::findOrFail($id);
    $product->delete();

    return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
}

}


