<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Currency;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Store;
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

        // dd($request->all());
        try {
            // Validate the form data
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'basic_unit' => 'nullable',
                'cover_image' => 'required|image',
                'amount' => 'required|numeric',
                'discount_price' => 'nullable|numeric',
                'description' => 'required',
                'currency_id' => 'required|exists:currencies,id',
                'brand_id' => 'required|exists:brands,id',
                'store_id' => 'nullable|exists:stores,id',
                'category_id' => 'required|exists:product_categories,id',
                'meta_description' => 'nullable|max:200',
                'meta_keyword' => 'nullable:array',
            ]);


            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $user_id = Auth::user()->id;
            $cover_image = FileHelpers::saveImageRequest($request->file('cover_image'), 'product/cover_images/');


            $amount = $request->input('amount');
            $discount_price = $request->input('discount_price');

            $discount_percent = null;
            if ($request->has('discount_price')) {
                $discount_percent = (($amount - $discount_price) / $amount) * 100;
            }

            Product::create([
                'user_id' => $user_id,
                'name' => $request->input('name'),
                'basic_unit' => $request->input('basic_unit'),
                'category_id' => $request->input('category_id'),
                'brand_id' => $request->input('brand_id'),
                'store_id' => $request->input('store_id') ?? null,
                'currency_id' => $request->input('currency_id'),
                'cover_image' => $cover_image,
                'amount' => $amount,
                'discount_price' => $discount_price ?? null,
                'discount_percent' => $discount_percent,
                'description' => $request->input('description'),
                'meta_description' => $request->input('meta_description') ?? null,
                'meta_keyword' => is_array($request->input('meta_keywords')) ? implode(',', $request->input('meta_keywords')) : null,
            ]);


            return redirect()->route('admin.dashboard.product.index')->with('success_message', 'Product successfully saved.');
        } catch (ValidationException $e) {
            // Handle the exception
            return redirect()->back()->with('error_message', 'An error occurred. Please try again later.', $e);
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
            // Validate the form data
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'basic_unit' => 'nullable',
                'cover_image' => 'nullable|image',
                'amount' => 'required|numeric',
                'discount_price' => 'nullable|numeric',
                'description' => 'required',
                'currency_id' => 'required|exists:currencies,id',
                'brand_id' => 'required|exists:brands,id',
                'store_id' => 'nullable|exists:stores,id',
                'category_id' => 'required|exists:product_categories,id',
                'meta_description' => 'nullable|max:200',
                'meta_keyword' => 'nullable:array',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $product = Product::where('id', $id)->first();
            $user_id = Auth::user()->id;

            $old_cover_image = $product->cover_image;
            if ($request->file('cover_image')) {
                $cover_image = FileHelpers::saveImageRequest($request->file('cover_image'), 'product/cover_images/');
            } else {
                $cover_image = $old_cover_image;
            }

            $amount = $request->input('amount');
            $discount_price = $request->input('discount_price');

            $discount_percent = null;
            if ($request->has('discount_price')) {
                $discount_percent = (($amount - $discount_price) / $amount) * 100;
            }

            $product->update([
                'user_id' => $user_id,
                'name' => $request->input('name'),
                'basic_unit' => $request->input('basic_unit'),
                'category_id' => $request->input('category_id'),
                'brand_id' => $request->input('brand_id'),
                'store_id' => $request->input('store_id') ?? null,
                'currency_id' => $request->input('currency_id'),
                'cover_image' => $cover_image,
                'amount' => $amount,
                'discount_price' => $discount_price ?? null,
                'discount_percent' => $discount_percent,
                'description' => $request->input('description'),
                'meta_description' => $request->input('meta_description') ?? null,
                'meta_keyword' => is_array($request->input('meta_keywords')) ? implode(',', $request->input('meta_keywords')) : null,
            ]);


            return redirect()->route('admin.dashboard.product.index')->with('success_message', 'Product successfully updated.');
        } catch (ValidationException $e) {
            // Handle the exception
            return redirect()->back()->with('error_message', 'An error occurred. Please try again later.', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete(); // This will perform a soft delete
            return back()->with('success_message', 'Product deleted successfully');
        } else {
            return back()->with('error_message', 'Product not found');
        }
    }
}
