@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Update Post</title>

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        </head>

        <body>

            <div class="container d-flex justify-content-center align-items-center vh-100">
                <form action="{{ route('post.update', $post->id) }}" method="POST">
                    @csrf
                    <div class="mb-3 mt-5">
                        <label for="title" class="form-label">Select Category:</label>
                        <select class="form-select" aria-label="Default select example" name="category_id">
                            <option selected disabled>{{ $post->title }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" placeholder="Enter title" name="title"
                            value="{{ $post->title }}">
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="content" class="form-label">Content:</label>
                        <textarea class="form-control" id="content" rows="4" placeholder="Enter content" name="content">{{ $post->content }}</textarea>
                        @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <!-- Bootstrap JS (optional, if you need it for other features) -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        </body>

    </html>
@endsection