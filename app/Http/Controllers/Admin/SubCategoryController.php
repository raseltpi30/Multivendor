<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    // Show all subcategories
    public function index()
    {
        $categories = Category::all();
        $subcategories = SubCategory::with('category')->get();
        return view('admin.subcategory.index', compact('subcategories','categories'));
    }

    // Store a new subcategory
    public function store(Request $request)
    {
        $request->validate([
            'subcategory_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        SubCategory::create([
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category_id,
        ]);

        $notification = array(
            'message' => 'Subcategory Added Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.subcategory')->with($notification);
    }

    // Show the edit form
    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::all();
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    // Update subcategory
    public function update(Request $request, $id)
    {
        $request->validate([
            'subcategory_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $subcategory = SubCategory::findOrFail($id);
        $subcategory->update([
            'subcategory_name' => $request->subcategory_name,
            'category_id' => $request->category_id,
        ]);

        $notification = array(
            'message' => 'Subcategory Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.subcategory')->with($notification);
    }

    // Delete subcategory
    public function destroy($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->delete();

        $notification = array(
            'message' => 'Subcategory Deleted Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
