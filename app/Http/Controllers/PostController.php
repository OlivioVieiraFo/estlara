<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;

Use App\Models\Post;


use Illuminate\Http\request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::get();

        //dd($posts);
        
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        
        $post = Post::create($request->all());

        Return redirect()->route('posts.index');
    }
}
