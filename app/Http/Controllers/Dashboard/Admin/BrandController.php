<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Constants\StatusConstants;
use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::get();
        return view('dashboard.admin.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statusOptions = StatusConstants::ACTIVE_OPTIONS;
        return view('dashboard.admin.brand.create', compact('statusOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'logo' => 'required|image',
                'name' => 'required|string|unique:brands,name|max:100',
                'status' => 'required|string',
            ]);
            if ($request->file('logo')) {
                $logo_path = FileHelpers::saveImageRequest($request->logo, 'brands/logos/');
            } else {
                return back()->withInput()->withErrors(['logo' => 'Logo upload failed.']);
            }

            $uuid = Brand::generateUUID(20);

            Brand::create([
                'logo' => $logo_path,
                'name' => $request->input('name'),
                'uuid' => $uuid,
                'status' => $request->input('status'),
            ]);

            return redirect()->route('admin.dashboard.brand.index')->with('success_message', 'Brand Created');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['logo' => 'An error occurred while creating the brand.']);
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
        $brand = Brand::findOrFail($id);
        return view('dashboard.admin.brand.edit', [
            'brand' => $brand,
            'statusOptions' => $statusOptions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'logo' => 'required|image',
                'name' => ['required', 'string', Rule::unique('brands', 'name')->ignore($id)],
                'status' => 'required|string',
            ]);


            if ($request->file('logo')) {
                $logo_path = FileHelpers::saveImageRequest($request->logo, 'brands/logos/');
            } else {
                return back()->withInput()->withErrors(['logo' => 'Logo upload failed.']);
            }

            $brand = Brand::findOrFail($id);
            $brand->update([
                'logo' => $logo_path,
                'name' => $request->input('name'),
                'status' => $request->input('status'),
            ]);

            return redirect()->route('admin.dashboard.brand.index')->with('success_message', 'Brand Updated');
        } catch (ValidationException $e) {
            return back()->withInput()->withErrors($e->errors());
        } catch (\Exception $e) {
            return back()->withInput()->withErrors(['logo' => 'An error occurred while updating the brand.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        return back()->with('success_message', 'Brand Deleted Successfully');
    }
}
