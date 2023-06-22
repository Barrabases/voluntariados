<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
    //----------------------------------------------------------------------------
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.index');
    }
    //----------------------------------------------------------------------------
    /**
     * En esta funcion se almacena cualquier tipo de recuerso creado en la base de datos
     */
    public function store(Request $request)
    {
        //return $request->all();
        $post = new Post; // Nuevo post.
        $userId = Auth::id(); // Autentificacion por id.
        $post->title = $request->title; // Titulo del post.
        $post->body = $request->body;  // Cuerpo del post.
        //$post->created_by = $userId;  // id de la organizacion la cual creo el post
        $user = User::find($userId); // Obtener el usuario correspondiente al ID

         if ($user) {
            $organizationName = $user->name; // Obtener el nombre de la organización

        $post->created_by = $organizationName; // Asignar el nombre de la organización al campo 'created_by'
    }

        if ($request->hasFile('image')){ // En este trozo de codigo se hace el cambio de la imagen
            $file = $request->file('image'); // para que se almacene en la carpeta 'public' y la reconozca como archivo.
            $path = Storage::putFile('public/images/', $request->file('image'));
            $nuevo_path = str_replace('public/','',$path);
            $post->image_url = $nuevo_path;
        }
        $post->save(); // se guarda el post
        return redirect()->route('posts.index'); // y la ruta
        
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    //----------------------------------------------------------------------------
    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //Estos recursos no fueron modificados pero sirven para darle mas funcionalidades al programa
    }
     //----------------------------------------------------------------------------
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //Estos recursos no fueron modificados pero sirven para darle mas funcionalidades al programa
    }
    //----------------------------------------------------------------------------
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //Estos recursos no fueron modificados pero sirven para darle mas funcionalidades al programa
    }
    //----------------------------------------------------------------------------
    /**
     * Funcion para eliminar un post de la pagina y base de datos con solo un boton
     */
    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        if($post->image_url){ //Si post tiene declarado dentro de si una imagen, se borra la immagen localizada en public
            Storage::delete('public/'.$post->image_url);
        }
        $post->delete(); //Basicamente se usa la funcion para eliminar dentro de post, vaciandola
        return redirect()->route('posts.index');
    }
}
