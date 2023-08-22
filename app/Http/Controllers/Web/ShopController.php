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
        $categories = ProductCategory::where('status', 'active')
            ->whereNull('parent_id')
            ->get();
        $products = Product::where('status', 'active')->paginate(50);
        return view('web.shop.index', [
            'products' => $products,
            'categories' => $categories,
        ]);
    }

    public function details($id, ProductCategory $category)
    {
        $product = Product::where('status', 'active')->findOrFail($id);
        $product->increment('view_count');
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

    public function fetchProductsByCategory($name)
    {
        $category = ProductCategory::where('status', 'active')->where('name', $name)->firstOrFail();
        $filteredProducts = $category->products()->where('status', 'active')->latest()->get();
    
        return view('web.shop.index', [
            'filteredProducts' => $filteredProducts,
        ]);
    }
}
