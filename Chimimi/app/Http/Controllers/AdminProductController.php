<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->paginate(3);
        return view('admin.products', compact('products'));
    }

    public function create()
    {
        return view('admin.create-product');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'price_frozen' => 'required|integer|min:0|multiple_of:1000',
            'price_cooked' => 'required|integer|min:0|multiple_of:1000',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Product::create([
            'name' => $request->name,
            'category' => $request->category,
            'ingredients' => $request->ingredients,
            'price_frozen' => $request->price_frozen,
            'price_cooked' => $request->price_cooked,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product added!');
    }

    public function edit(Product $product)
    {
        return view('admin.edit-product', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'ingredients' => 'required|string',
            'price_frozen' => 'required|integer|min:0|multiple_of:1000',
            'price_cooked' => 'required|integer|min:0|multiple_of:1000',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'ingredients', 'price_frozen', 'price_cooked']);

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            // Simpan file baru
            $data['image_path'] = $request->file('image')->store('images', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Product updated!');
    }
    
     public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted!');
    }
}