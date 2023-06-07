<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->all();
        $post = new Post;
        $userId = Auth::id();

        $post->title = $request->title;
        $post->body = $request->body;
        $post->created_by = $userId;
        if ($request->hasFile('image')){
            $file = $request->file('image');
            $path = Storage::putFile('public/images/', $request->file('image'));
            $nuevo_path = str_replace('public/','',$path);
            $post->image_url = $nuevo_path;
        }
        $post->save();
        return redirect()->route('posts.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post_id)
    {
        //Función para destruir las publicaciones.

        $post = Post::find($post_id);
        if($post->image_url){
            Storage::delete('public/'.$post->image_url);
        }
        $post->delete();
        return redirect()->route('posts.index');
    }
}
