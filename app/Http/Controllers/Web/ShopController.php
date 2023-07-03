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
        $categories = ProductCategory::paginate(3);
        $products = Product::where('status', 'active')->get();
        return view('web.shop.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function details($id, ProductCategory $category)
    {
        $product = Product::where('status', 'active')->findOrFail($id);
        $related_products = Product::where('category_id', $product->category_id)
            ->where('status', 'active')
            ->where('id', '!=', $product->id)
            ->get();

        // dd($related_products);

        return view('web.shop.product-details', [
            'product' => $product,
            'related_products' => $related_products,
        ]);
    }
}
