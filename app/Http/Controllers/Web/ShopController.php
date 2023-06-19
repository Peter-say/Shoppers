<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
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
}
