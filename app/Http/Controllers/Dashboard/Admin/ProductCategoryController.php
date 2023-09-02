<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Constants\StatusConstants;
use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = ProductCategory::whereNull('parent_id')->get();
        return view('dashboard.admin.product.category.index', [
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
                $image = FileHelpers::saveImageRequest($request->image, 'product/category/images/');
                $image_path = pathinfo($image, PATHINFO_BASENAME);
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
        $statusOptions = StatusConstants::ACTIVE_OPTIONS;
        $category = ProductCategory::where('id', $id)->first();
        return view('dashboard.admin.product.category.edit', [
            'category' => $category,
            'statusOptions' => $statusOptions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */


    public function update(Request $request, string $id)
    {
        try {
            $category = ProductCategory::findOrFail($id);
            $old_image = $category->image;

            // Process image upload
            if ($request->file('image')) {
                $image = FileHelpers::saveImageRequest($request->image, 'product/category/images/');
                $image_path = pathinfo($image, PATHINFO_BASENAME);
            } else {
                $image_path = $old_image;
            }

            $category->update([
                'name' => $request->input('name'),
                'image' => $image_path,
                'status' => $request->input('status'),
            ]);
            return redirect()->route('admin.dashboard.product-category.index')
                ->with('success_message', 'Category Updated');
        } catch (ModelNotFoundException $e) {
            return back()->with('error_message', 'Category not found.');
        } catch (\Exception $e) {
            return back()->with('error_message', 'An error occurred while updating the category.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ProductCategory::where('id', $id)->first();
        $category->delete();
        return back()->with('success_message', 'Category Deleted');
    }
}
