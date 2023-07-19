@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories List</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container-fluid d-flex justify-content-center align-items-center mt-4">
        <div class="container">
            <h1 class="text-center mb-4">Categories List</h1>
            <div class="row justify-content-center mb-4">
                <div class="col-auto mb-4">
                    <form action="{{ route('categories.index') }}" method="GET" class="d-flex">
                        <input type="text" name="search" class="form-control me-2" placeholder="Search categories">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>
                @if($categories->isEmpty())
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
                                @if(Auth::user()->role == 'admin')
                                    <th>Edit</th>
                                    <th>Delete</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td>{{ $category->title }}</td>
                                    @if(Auth::user()->role == 'admin')
                                        <td>
                                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-success">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('category.destroy', $category->id) }}" class="btn btn-danger" onClick ="return confirm('Are you sure to delete this category?')">Delete</a>                                
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, if you need it for other features) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection