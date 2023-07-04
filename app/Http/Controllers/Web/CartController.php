<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index($id)
    {
        $product = Product::where('status', 'active')->where('id', $id)->first();
        $related_products = Product::where('category_id', $product->category_id)
            ->where('status', 'active')
            ->where('id', '!=', $product->id)
            ->get();
        return view('web.shop.product-details', [
           'product' => $product,
           ' related_products' =>  $related_products,
        ]);
    }

    public function cartList()
    {
        return view('web.shop.cart-list');
    }
}
