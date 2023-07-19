@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Posts List</title>

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        </head>

        <body>
            <div class="container-fluid d-flex justify-content-center align-items-center mt-4">
                <div class="container">
                    <h1 class="text-center mb-4">Posts List</h1>
                    <div class="row justify-content-center mb-4">
                        <div class="col-auto mb-4">
                            <form action="{{ route('posts.index') }}" method="GET" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Search posts">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                        @if($posts->isEmpty())
                            <div class="col-auto mb-4">
                                <tr>
                                    <td> <h3> There is no related Record: </h3></td>
                                </tr>
                            </div>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Author</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{ $post->id }}</td>
                                            <td>{{ $post->title }}</td>
                                            <td>{{ $post->content }}</td>
                                            <td>{{ $post->userName }}</td>
                                            <td>{{ $post->categoryTitle }}</td>
                                            <td>
                                                <a href="{{ route('post.destroy', $post->id) }}" class="btn btn-danger" onClick ="return confirm('Are you sure to delete this post?')">Delete</a>
                                                <a href="{{ route('post.edit', $post->id) }}" class="btn btn-success">Edit</a>
                                                <a href="{{ route('post.show', $post->id) }}" class="btn btn-success">Show Post</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>

                <!-- Bootstrap JS (optional, if you need it for other features) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>

    </html>
@endsection