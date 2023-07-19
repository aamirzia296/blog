@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Document</title>
        </head>

        <body>
            <div class="container-fluid d-flex justify-content-center align-items-center mt-4">
                <div class="container">
                    <h1>{{ $post->title }}</h1>
                    <p>{{ $post->content }}</p>
                    <p>{{ $post->views }}</p>
                
                    <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success">Edit</a>
                    <a href="{{ route('post.destroy', $post->id) }}" class="btn btn-danger" onClick ="return confirm('Are you sure to delete this post?')">Delete</a>
                </div>
            </div>
        </body>

    </html>
@endsection