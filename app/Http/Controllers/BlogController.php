<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    public function index()
    {
        $blogs = Blog::where('category_id', 1)->orderBy('id', 'desc')->paginate(12);

        return view('frontend.website.blogs', compact('blogs'));
    }

    public function blogDetails(Request $request)
    {
        $blog = Blog::where('slug', $request->slugs)->first();
        if(!$blog){
            abort(404);
        }

        $recents = Blog::where('slug', '!=', $request->slugs)
                    ->where('category_id', $blog->category_id)
                    ->orderby('created_at', 'desc')->limit(10)->get();

        return view('frontend.website.blog-details', compact('blog', 'recents'));
    }

    public function news()
    {
        $blogs = Blog::where('category_id', 3)->orderBy('id', 'desc')->paginate(12);

        return view('frontend.website.news', compact('blogs'));
    }

    public function newsDetails(Request $request)
    {
        $blog = Blog::where('slug', $request->slugs)->first();
        if(!$blog){
            abort(404);
        }

        $recents = Blog::where('slug', '!=', $request->slugs)
                    ->where('category_id', $blog->category_id)
                    ->orderby('created_at', 'desc')->limit(10)->get();

        return view('frontend.website.news-details', compact('blog', 'recents'));
    }


    public function events()
    {
        $blogs = Blog::where('category_id', 2)->orderBy('id', 'desc')->paginate(12);

        return view('frontend.website.events', compact('blogs'));
    }

    public function eventDetails(Request $request)
    {
        $blog = Blog::where('slug', $request->slugs)->first();
        if(!$blog){
            abort(404);
        }

        $recents = Blog::where('slug', '!=', $request->slugs)
                    ->where('category_id', $blog->category_id)
                    ->orderby('created_at', 'desc')->limit(10)->get();

        return view('frontend.website.event-details', compact('blog', 'recents'));
    }




}
