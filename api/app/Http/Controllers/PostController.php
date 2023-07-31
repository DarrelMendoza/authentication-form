<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the posts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return response()->json($posts);
    }

    /**
     * Store a newly created post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $post = Post::create(request()->all());
        return response()->json($post);
    }

    /**
     * Display the specified post.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve the post with the given id
        $post = Post::findOrFail($id);
        return response()->json($post);
    }

    /**
     * Update the specified post in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // Retrieve the post and update it with the request data
        $post = Post::findOrFail($id);
        $post->update(request()->all());
        return response()->json($post);
    }

    public function destroy($id)
    {
        // Retrieve the post and delete it
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json('Post deleted successfully');
    }
}
