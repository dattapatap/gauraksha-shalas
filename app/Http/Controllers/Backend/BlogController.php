<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\BlogCategory;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class BlogController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('backend.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = BlogCategory::where('status', 1)->get();
        return view('backend.blogs.create', compact('categories'));
    }

    public function getCategories(Request $request)
    {
        $Categories = Category::where('category_id', $request->id)->where('status', 1)->get();
        return $Categories;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image','mimes:jpeg,png,jpg', 'max:3000'],
            'title' => ['required', 'max:200', 'unique:blogs,title'],
            'category' => ['required'],
            'desc' => ['required'],
            'seo_title' => ['nullable', 'max:200'],
            'blog_status' => ['required','numeric'],
            'seo_description' => ['nullable', 'max:200']
        ]);

        $imagePath = $this->uploadImage($request, 'image', 'blogs', 1020, 570);

        $blog = new Blog();
        $blog->image = $imagePath;
        $blog->title = ucfirst($request->title);
        $blog->slug = Str::slug($request->title);

        $blog->category_id = $request->category;
        $blog->description = $request->desc;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->blog_status;

        $blog->save();

        toastr('Blog/News/Events Created successfully', 'success');

        return redirect()->route('admin.blogs.index');


    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::where('status', 1)->get();
        return view('backend.blogs.edit', compact('blog', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'title' => ['required', 'max:200', 'unique:blogs,title,'.$id],
            'category' => ['required'],
            'desc' => ['required'],
            'blog_status' => ['required','numeric'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:200']
        ]);

        $blog = Blog::findOrFail($id);

        $imagePath = $this->updateImage($request, 'image', 'blogs', 1020, 570, $blog->image);

        $blog->image = !empty($imagePath) ? $imagePath : $blog->image;
        $blog->title = ucfirst($request->title);
        $blog->slug = Str::slug($request->title);

        $blog->category_id = $request->category;
        $blog->description = $request->desc;
        $blog->seo_title = $request->seo_title;
        $blog->seo_description = $request->seo_description;
        $blog->status = $request->blog_status;

        $blog->save();

        toastr('Blog/News/Events Update successfully', 'success');

        return redirect()->route('admin.blogs.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);
        $this->deleteImage($blog->image);
        // $blog->comments()->delete();
        $blog->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $blog->status = $request->status == 'true' ? 1 : 0;
        $blog->save();

        return response(['message' => 'Status has been updated!']);
    }
}
