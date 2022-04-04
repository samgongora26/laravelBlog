<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
// use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

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
        
        return back()->with("status","Creado con exito");
                        
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
     * Display the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function show(Posts $posts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function edit(Posts $posts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Posts $posts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Posts  $posts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Posts $posts)
    {
        //
    }
}
