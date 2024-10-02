<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Str;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog_category = BlogCategory::paginate(10);
        return view('backend.blog-category.index',compact('blog_category'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.blog-category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'unique:blog_categories'],
            'status' => ['required']
        ],[
            'name.unique' => 'Category already exist!'
        ]);

        $category = new BlogCategory();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->status = $request->status;
        $category->save();

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('admin.blog_category.index');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        return view('backend.blog-category.edit', compact('blog_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200', 'unique:blog_categories,name,'.$id],
            'status' => ['required']
        ],[
            'name.unique' => 'Blog Category already exist!'
        ]);

        $blog_category = BlogCategory::findOrFail($id);
        $blog_category->name = $request->name;
        $blog_category->slug = Str::slug($request->name);
        $blog_category->status = $request->status;
        $blog_category->save();

        toastr('Updated Successfully!', 'success', 'success');

        return redirect()->route('admin.blog_category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog_category = BlogCategory::findOrFail($id);
        $blog_category->delete();

        return response(['status' => 'success', 'message' => 'Deleted successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $blog_category = BlogCategory::findOrFail($request->id);
        $blog_category->status = $request->status == 'true' ? 1 : 0;
        $blog_category->save();

        return response(['message' => 'Status has been updated!']);
    }
}
