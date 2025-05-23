<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::paginate(10);
        return view('admin.category.index', compact('categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $slug = Str::slug($request->category_name);
        Category::create([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.category')->with([
            'message' => 'Category Created Successfully!',
            'alert-type' => 'success',
        ]);
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);
        $category = Category::findOrFail($id);
        $slug = Str::slug($request->category_name);
        $category->update([
            'category_name' => $request->category_name,
            'category_slug' => $slug,
            'status' => $request->status,
        ]);
        return redirect()->back()->with([
            'message' => 'Category updated successfully!',
            'alert-type' => 'success',
        ]);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        $notification = array('message' => 'Category Deleted Successfully!', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
