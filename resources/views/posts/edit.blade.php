@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar artículo</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('posts.update', $post) }}"
                        method="POST"
                        enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Título * </label>
                            <input type="text" name="title" class="form-control" required
                                value="{{ old('title', $post->title) }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Image </label>
                            <input type="file" name="file" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contenido * </label>
                            <textarea type="text" name="body" class="form-control" required
                                value="" rows="6">{{ old('body', $post->body) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contenido embebido * </label>
                            <textarea type="text" name="iframe" class="form-control"
                                value="">{{ old('iframe', $post->iframe) }}</textarea>
                        </div>
                        <div class="mb-3">
                            @csrf 
                            @method('PUT')
                            <input type="submit" value="Actualizar" class="btn btn-sm btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
