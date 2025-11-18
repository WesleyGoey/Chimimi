<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index(Request $request)
   {
       if ($request->has('search')) {
            $products = Product::where('name', 'like', '%' . $request->search . '%')
                ->orWhere('category', 'like', '%' . $request->search . '%')
                ->orWhere('ingredients', 'like', '%' . $request->search . '%')
                ->paginate(3)
                ->withQueryString();
        } else {
            $products = Product::orderBy('id', 'asc')->paginate(3);
        }

        return view('products', compact('products'));
   }
}