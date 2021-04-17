<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $carousel_posts = Post::all()->random(3);
        $posts = Post::paginate(4);
        $categories = Category::all();
        return view('home', compact('posts', 'carousel_posts', 'categories'));
    }

    public function post(Post $post)
    {
        return view('post', compact('post'));
    }

    public function categoryPost(Category $category)
    {
        $posts = Post::where('category_id', '=', $category->id)->paginate(4);
        return view('posts_category', compact('posts', 'category'));
    }

    public function monthPosts($month)
    {
        $posts = Post::where('creation_date', '<=', date('Y') . '-' . $month . '-' . '31')
            ->where('creation_date', '>=', date('Y') . '-' . $month . '-' . '01')->paginate(4);
        return view('posts_month', compact('posts', 'month'));
    }

    public function search(Request $request)
    {
        $posts = Post::where('title', 'LIKE', '%'.$request->search.'%')->paginate(4);
        $carousel_posts = Post::all()->random(3);
        $categories = Category::all();
        return view('home', compact('posts', 'carousel_posts', 'categories'));
    }
}
