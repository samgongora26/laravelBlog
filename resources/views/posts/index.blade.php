@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <span>Articulos</span> 
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm float-right">Crear</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Título</th>
                                <th colspan="2">&nbsp; </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <th>{{ $post->id }}</th>
                                <th>{{ $post->title }}</th>
                                <th>
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-primary">
                                        Editar
                                    </a>
                                </th>
                                <th>
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input 
                                            type="submit" 
                                            value="Eliminar"
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Desea elimnar?')"
                                        >
                                    </form>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
