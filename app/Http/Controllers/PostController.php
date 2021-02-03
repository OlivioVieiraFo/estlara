<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePost;

Use App\Models\Post;


use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'ASC')->paginate();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {
        
        $post = Post::create($request->all());

        return redirect()
                ->route('posts.index')
                ->with('message', 'Post criado com sucesso!');
    }

    public function show($id)
    {
        if (!$post = Post::find($id)){

            return redirect()->route('posts.index');
        }

        // dd($post);

        return view('admin.posts.show', compact('post'));

    }

    public function destroy($id)
    {

        if (!$post = Post::find($id))

            return redirect()->route('posts.index');
        
        $post->delete();

        return redirect()
                ->route('posts.index')
                ->with('message', 'Post deletado com sucesso!');


    }

    public function edit($id)
    {
        if (!$post = Post::find($id)){
            return redirect()->back();
        }

        // dd($post);

        return view('admin.posts.edit', compact('post'));

    }

    public function update(StoreUpdatePost $request, $id)
    {
        if (!$post = Post::find($id)){
            return redirect()->back();
        }

        $post->update($request->all());

        return redirect()
        ->route('posts.index')
        ->with('message', 'Post atualizado com sucesso!');
    }

    public function search(Request $request)
    {
        $posts = Post::where('title', 'LIKE', "%{$request->search}%")
                        ->orwhere('content', 'LIKE', "%{$request->search}%")
                        ->paginate();

        return view('admin.posts.index', compact('posts'));
    }
}
