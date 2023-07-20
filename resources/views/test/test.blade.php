<!DOCTYPE html>
    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Post Create</title>

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        </head>

        <body>
            <div class="container d-flex justify-content-center align-items-center">
                <form action="{{ route('test.store')}}" method="POST">
                    @csrf
                    <div class="mb-3 mt-5">
                        <label for="name" class="form-label"> Name </label>
                        <input type="text" name="name" id="name" placeholder="Enter name" class="form-control">
                    </div>
                    <div class="mb-3 mt-5">
                        <label for="description" class="form-label"> Description </label>
                        <input type="text" name="description" id="description" placeholder="Enter Description" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="ajaxCall()">Submit</button>
                </form>
            </div>
        </body>
    </html>