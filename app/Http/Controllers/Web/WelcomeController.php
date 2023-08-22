<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Admin\ProductController;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $categories = ProductCategory::where('status', 'active')
            ->whereNull('parent_id')
            ->get();
        return view('web.welcome', compact('categories'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');

        $products = Product::where(function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('description', 'like', '%' . $keyword . '%')
                ->orWhere('amount', 'like', '%' . $keyword . '%')
                ->orWhere('meta_keyword', 'like', '%' . $keyword . '%');
        })
        ->paginate(20);
        $categories = ProductCategory::where('status', 'active')
        ->whereNull('parent_id')
        ->get();
        return view('web.shop.search-items-page', compact('products', 'categories'));
    }
}
