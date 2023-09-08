<?php

namespace App\Http\Controllers\Web\Category;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
    {
        $featuredProducts = Product::where('status', 'active')->where('is_featured', 1)->get();
        $categories = ProductCategory::where('status', 'active') ->whereNull('parent_id')->get();
        return view('web.shop.category.category', [
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
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
        $categories = ProductCategory::where('status', 'active')->whereNull('parent_id')->get();
        $subcategory = ProductCategory::with('children.products')->where('name', $name)->firstOrFail();
        $subcategoryChild = $subcategory->where('name', $name)->firstOrFail();
        $productIds = $subcategory->children->pluck('products')->flatten()->pluck('id')->toArray();
        $products = Product::whereIn('id', $productIds)->where('status', 'active')->paginate(50);
        

        return view('web.shop.category.category-products',[
            'products' => $products,
            'categories' => $categories,
            'subcategory' =>  $subcategory,
            'subcategoryChild' => $subcategoryChild
        ]);
    }
}
