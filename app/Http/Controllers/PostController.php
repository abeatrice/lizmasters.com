<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('sort_order', 'desc')->paginate();

        return view('posts.index', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image_path' => 'required|image'
        ]);

        Post::create([
            'title' => $request->title,
            'sort_order' => Post::max('sort_order') + 1 ,
            'description' => $request->description,
            'published' => $request->published ? true : false,
            'image_path' => $request->file('image_path')->store('images', 'public')
        ]);

        return redirect('/posts');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('/posts/edit', compact('post'));
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
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $post->update([
            'title' => $request->title,
            'description' => $request->description,
            'published' => $request->published ? true : false
        ]);

        return redirect('/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->deleteImage();
        
        $post->delete();

        return redirect('/posts');        
    }

    /** 
     * Change sort order of a post with the one above or below it 
     * 
     * @param  \App\Post  $post
     * @param  string  $direction
     * @return \Illuminate\Http\Response
    */
    public function changeSortOrder(Post $post, $direction)
    {
        $highestPost = Post::where('sort_order', Post::max('sort_order'))->first();
        if($direction == 'up' and $post == $highestPost) return redirect('posts');

        $lowestPost = Post::where('sort_order', Post::min('sort_order'))->first();
        if($direction == 'down' and $post == $lowestPost) return redirect('posts');

        if($direction == 'up') {
            Post::where('sort_order', $post->sort_order + 1)->decrement('sort_order');
            $post->increment('sort_order');
        } else {
            Post::where('sort_order', $post->sort_order - 1)->increment('sort_order');
            $post->decrement('sort_order');
        }

        return redirect('posts');
    }
}
