<?php

namespace App\Http\Controllers\Web\Category;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        $categories = ProductCategory::where('status', 'active')
            ->whereNull('parent_id')
            ->get();
        return view('web.shop.category.category', [
            'categories' => $categories,
        ]);
    }

    public function subcategory($subcategory)
    {
        $subcategory = ProductCategory::where('status', 'active')
            ->where('name', urldecode($subcategory))
            ->with('children')
            ->firstOrFail();

        return view('web.shop.category.subcategory', [
            'category' => $subcategory,
        ]);
    }

    public function categoryProducts($name)
    {
        $category  = ProductCategory::with('products')->where('name', $name)->firstOrFail();
        $products = $category->products->where('status', 'active');
        return view('web.shop.category.category-products', compact('products'));
    }
}
