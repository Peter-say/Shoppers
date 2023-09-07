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
use Exception;
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
        $statusOptions = StatusConstants::ACTIVE_OPTIONS;
        $stockOptions = StatusConstants::STOCK_STATUS;
        return view('dashboard.admin.product.create', [
            'user' => $user,
            'brands' => $brands,
            'stores' => $stores,
            'categories' => $categories,
            'currencies' => $currencies,
            'currencies' => $currencies,
            'statusOptions' => $statusOptions,
            'stockOptions' => $stockOptions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $createdProduct = ProductService::storeProduct($request);

            if ($createdProduct) {
                return redirect()->route('admin.dashboard.product.index')
                    ->with('success_message', 'Product successfully created.');
            } else {
                return redirect()->back()
                    ->with('error_message', 'An error occurred while creating the product. Please try again.');
            }
        } catch (Exception $e) {
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
        $statusOptions = StatusConstants::ACTIVE_OPTIONS;
        $stockOptions = StatusConstants::STOCK_STATUS;

        $product = Product::where('id', $id)
            ->where('status', 'active')
            ->with('currency')->with('brand')->first();
        return view('dashboard.admin.product.edit', [
            'product' => $product,
            'user' => $user,
            'brands' => $brands,
            'stores' => $stores,
            'categories' => $categories,
            'currencies' => $currencies,
            'statusOptions' => $statusOptions,
            'stockOptions' => $stockOptions,

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
        } catch (Exception $e) {
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


    public function updateFeatured(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->update(['is_featured' => $request->input('is_featured')]);
            session()->flash('success_message', 'Product featured updated');
        } catch (Exception $e) {
            session()->flash('error_message', 'Can not update' . $e->getMessage());
        }
        return redirect()->back();
    }
}
