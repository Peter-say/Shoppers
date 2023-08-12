<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Helpers\ApiHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ProductResource;
use App\Models\Product;
use App\Services\Product\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::all();
            $productResource = ProductResource::collection($products);
            return ApiHelper::successResponse('Products retrieved successfully.', $productResource);
        } catch (\Exception $e) {
            return ApiHelper::errorResponse('An error occurred while fetching products. Please try again later.', 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $createdProduct = ProductService::storeProduct($request);

            if ($createdProduct) {
                return ApiHelper::successResponse('Product successfully created.', $createdProduct, 201);
            } else {
                return ApiHelper::errorResponse('An error occurred while creating the product. Please try again.', 500);
            }
        } catch (ModelNotFoundException $e) {
            return ApiHelper::errorResponse('An error occurred. Please try again later.', 500);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::findOrFail($id);

            $productResource = new ProductResource($product);
            return ApiHelper::successResponse('Product retrieved successfully.', $productResource);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiHelper::notFoundResponse('Product could not be found.', 404);
        } catch (\Exception $e) {
            return ApiHelper::errorResponse('An error occurred while fetching products. Please try again later.', 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $product = Product::findOrFail($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiHelper::notFoundResponse('Product could not be found.', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $createdProduct = ProductService::updateProduct($request, $id);

            if ($createdProduct) {
                return ApiHelper::successResponse('Product successfully updated.', $createdProduct, 201);
            } else {
                return ApiHelper::errorResponse('An error occurred while updating the product. Please try again.', 500);
            }
        } catch (ModelNotFoundException $e) {
            return ApiHelper::errorResponse('An error occurred. Please try again later.', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
        }
            return back()->with('success_message', 'Product deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return ApiHelper::notFoundResponse('Product could not be found.', 404);
        }
    }
}
