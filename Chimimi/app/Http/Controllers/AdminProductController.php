<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'asc')->paginate(10);
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
}