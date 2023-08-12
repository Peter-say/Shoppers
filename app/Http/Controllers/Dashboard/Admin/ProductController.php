<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Constants\StatusConstants;
use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
use App\Services\Product\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('status', 'active')->with('currency')->with('brand')->get();
        return view('dashboard.admin.product.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        $brands = Brand::get();
        $stores = Store::get();
        $categories = ProductCategory::get();
        $currencies = Currency::get();
        return view('dashboard.admin.product.create', [
            'user' => $user,
            'brands' => $brands,
            'stores' => $stores,
            'categories' => $categories,
            'currencies' => $currencies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

     public function store(Request $request)
     {
         try {
             $createdProduct = ProductService::storeProduct($request);
     
             if ($createdProduct) {
                 return redirect()->route('admin.dashboard.product.index')
                     ->with('success_message', 'Product successfully created.');
             } else {
                 return redirect()->back()
                     ->with('error_message', 'An error occurred while creating the product. Please try again.');
             }
         } catch (ModelNotFoundException $e) {
             return redirect()->back()
                 ->with('error_message', 'An error occurred. Please try again later.');
         }
     }
     


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = Auth::user();
        $brands = Brand::get();
        $stores = Store::get();
        $categories = ProductCategory::get();
        $currencies = Currency::get();
        $product = Product::where('id', $id)
            ->where('status', 'active')
            ->with('currency')->with('brand')->first();
        return view('dashboard.admin.product.edit', [
            'product' => $product,
            'user' => $user,
            'brands' => $brands,
            'stores' => $stores,
            'categories' => $categories,
            'currencies' => $currencies

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $createdProduct = ProductService::updateProduct($request, $id);
    
            if ($createdProduct) {
                return redirect()->route('admin.dashboard.product.index')
                    ->with('success_message', 'Product successfully updated.');
            } else {
                return redirect()->back()
                    ->with('error_message', 'An error occurred while updating the product. Please try again.');
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->back()
                ->with('error_message', 'An error occurred. Please try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
            return back()->with('success_message', 'Product deleted successfully');
        } else {
            return back()->with('error_message', 'Product not found');
        }
    }


    public function featuredProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update(['featured' => $request->input('featured')]);
        session()->flash('seccess_message', 'Product featured updated');
    }
}
