<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Constants\StatusConstants;
use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }
    
    public function createSubcategory($id)
    {
        $statusOption = StatusConstants::ACTIVE_OPTIONS;
        $category = ProductCategory::findOrFail($id);
        return view('dashboard.admin.product.category.subcategory.create', [
            'category' => $category,
            'statusOptions' => $statusOption,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $request->validate([
                'parent_id' => 'required|exists:product_categories,id',
                'name' => 'required|string|max:30',
                'image' => 'required|image',
            ]);


            $status = $request->input('status');
            if (!in_array($status, ['Active', 'Inactive'])) {
                return back()->withInput()->withErrors(['status' => 'Invalid status value.']);
            }

            if ($request->file('image')) {
                $image_path = FileHelpers::saveImageRequest($request->image, 'product/category/subcategory/images/');
            } else {
                return back()->withInput()->withErrors(['image' => 'Image upload failed.']);
            }
            ProductCategory::create([
                'parent_id' => $request->input('parent_id'),
                'name' => $request->input('name'),
                'image' => $image_path,
                'status' => $request->input('status'),
            ]);

            return redirect()->route('admin.dashboard.product-category.index')->with('success_message', 'Subcategory Created');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['image' => 'Error during image upload: ' . $e->getMessage()]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
