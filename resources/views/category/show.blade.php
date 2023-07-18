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
    <h1>{{ $category->title }}</h1>
    <form action="{{ route('category.destroy', $category->id) }}">
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</body>

</html>
@endsection