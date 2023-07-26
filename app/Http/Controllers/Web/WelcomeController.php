<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Admin\ProductController;
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
}
