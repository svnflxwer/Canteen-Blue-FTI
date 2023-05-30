<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('product.index', [
            'title' => 'Product',
            'active' =>'product',
            'products' => Product::filter(request(['search','sc']))->paginate(4)->withQueryString(),
            'best_products' => Product::all(),
            'categories' => SubCategory::where('is_active',1)->get(),
        ]);
    }
}