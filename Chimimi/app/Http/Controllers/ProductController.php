<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index()
   {
       $products = Product::orderBy('id', 'asc')->paginate(3);
       return view('products', compact('products'));
   }
}