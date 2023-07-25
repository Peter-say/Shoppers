<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Constants\StatusConstants;
use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::all();
        return view('dashboard.admin.product.category.index',[
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statusOptions = StatusConstants::ACTIVE_OPTIONS;
        return view('dashboard.admin.product.category.create', compact('statusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30',
            'status' => 'required|string',
            'image' => 'required|image|mimes:png,jpg,webm',
        ]);

        try {

            $status = $request->input('status');
            if (!in_array($status, ['Active', 'Inactive'])) {
                return back()->withInput()->withErrors(['status' => 'Invalid status value.']);
            }

            if ($request->file('image')) {
                $image_path = FileHelpers::saveImageRequest($request->image, 'product/category/images/');
            } else {
                return back()->withInput()->withErrors(['image' => 'Image upload failed.']);
            }
            ProductCategory::create([
                'name' => $request->input('name'),
                'image' => $image_path,
                'status' => $status,
            ]);

            return redirect()->route('admin.dashboard.product-category.index')->with('success_message', 'Category Created');
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
        $status = StatusConstants::ACTIVE_OPTIONS;
        $category = ProductCategory::where('id', $id)->first();
        return view('dashboard.admin.product.category.edit', [
            'category' => $category,
            'status' => $status,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:30',
            'image' => 'required|image',
            'status' => 'required|string',
        ]);

        $category = ProductCategory::where('id', $id)->first();
        $old_image = $category->image;

        if ($request->file('image')) {
            $image_path = FileHelpers::saveImageRequest($request->image, 'product/category/images/');
        } else {
            $image_path = $old_image;
        }

        $category->update([
            'name' => $request->input('name'),
            'image' => $image_path,
            'status' => $request->input('status'),
        ]);
        return back()->with('success_message', 'Category Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ProductCategory::where('id', $id)->first();
        $category->delete();
    }
}
