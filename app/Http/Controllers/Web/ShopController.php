<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'active')->get();
        return view('web.shop.index',[
            'products' => $products
        ]);
    }

    public function details($id, ProductCategory $category)
    {
        $categories = Product::where('id', $category->id)->where('status', 'active')->get();
        $product = Product::where('status', 'active')->findOrFail($id);
        return view('web.shop.product-details',[
            'product' => $product,
            'categories' => $categories,
        ]);
    }
}
