<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $post = new Post();
        return view('admin.posts.create', compact('post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['creation_date'] = date("Y-m-d");
        if($request->hasfile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $title = $request->title;
            $title = str_replace(" ", "-", strtolower($title));
            $file_name = "{$title}.{$extension}";
            $request->image->storeAs('public/img', $file_name);
            $data['image'] = 'img/'.$file_name;
        }
        else {
            $data['image'] = "img/imagem.jpg";
        }
        Post::create($data);
        return redirect()->route('posts.index')->with('success', true);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();   
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->all();
        $image = $post->image;
        if($request->hasfile('image')) {
            $extension = $request->image->getClientOriginalExtension();
            $title = $request->title;
            $title = str_replace(" ", "-", strtolower($title));
            $file_name = "{$title}.{$extension}";
            $request->image->storeAs('public/img', $file_name);
            $data['image'] = 'img/'.$file_name;
        }
        $post->update($data);
        if (Post::where('image', '=', $image)->count() == 0) {
            Storage::disk('public')->delete($image);
        }
        return redirect()->route('posts.index')->with('success', true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', true);
    }
}
