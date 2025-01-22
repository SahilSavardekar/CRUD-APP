<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Jakarta+Sans:wght@400&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('products.index')}}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="{{route('products.create')}}">Add a new product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.logout')}}">Logout</a>
                </li>
            </ul>


        </div>
    </nav>



    <!-- content starts -->
    <h1 style="text-align: center; padding: 20px; margin: 0; font-family: 'Jakarta Sans', sans-serif;">
        Removed Products
    </h1>

    @if (session()->has("success"))
    <div class="d-flex justify-content-center mt-3">
        <div class="alert alert-success alert-dismissible fade show text-center fw-bold" role="alert" style="width: 50%;">
            {{ session()->get("success") }}
        </div>
    </div>
    @endif

    @if (session()->has("error"))
    <div class="d-flex justify-content-center mt-3">
        <div class="alert alert-danger alert-dismissible fade show text-center fw-bold" role="alert" style="width: 50%;">
            {{ session()->get("error") }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif

    <br>

    <div class="container my-4">
        <div class="row justify-content-center">
            @foreach($allProducts as $product)
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card mb-5 shadow" style="width: 100%; background-color: #f9f9f9; border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-light">Quantity: {{$product->qty}}</li>
                        <li class="list-group-item bg-light">{{$product->text}}</li>
                    </ul>
                    <div class="card-body text-center p-3">
                        <form action="{{route('products.remove', ['id' => $product->id]) }}" method="post" class="d-inline">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete Permanently</button>
                        </form>
                        <form action="{{route('products.restore', ['id' => $product->id]) }}" method="post" class="d-inline">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-outline-success btn-sm">Restore</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>

</html>