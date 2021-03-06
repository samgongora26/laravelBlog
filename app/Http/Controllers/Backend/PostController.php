<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
// use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

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
        $posts = Post::latest()->get();
        return view('posts.index',[
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        // dd($request->all());
        //Salvar
        $post = Post::create([
            "user_id" => auth()->user()->id
            //obtener el campo user_id de post ||lo buscamos en autenticados/usuarios/id
        ]+ $request->all() );

        if($request->file("file")){

            $post->image= $request->file("file")->store("posts","public");
            $post->save();
        }
        
        return back()->with('status','Creado con exito');
                        
        //logica FUNCION STORE:   
        //1//creamos un post con el user_id y los datos del form de creacion
        //2//agarramos toda la info del form
        //3// si recibimos img:
            // (la guardamos en carpeta storage/app/public
            //en public se generara la carpeta "posts"
            // ahi se generara una ruta, y esa ruta se guarda en base de datos )
        //4 guardamos
        //5 retornamos a la vista anterior con un alert que dice creado con exit

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // dd($post);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // return view('posts.edit');
        // dd($request->all());
        $post->update($request->all());

        if($request->file('file')){
            // Storage::disk('public')->delete($post->image);
            $post->image = $request->file('file')->store('posts', 'public');
            $post->save();
        }
        return back()->with('status', 'actualizado con ??xito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Storage::disk('public')->delete($post->image);
        $post->delete();
        return back()->with('status', 'Eliminado con ??xito');
    }
}
