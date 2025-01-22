<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Jakarta+Sans:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body style="font-family: 'Jakarta Sans', sans-serif;">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('welcome')}}">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('products.create') }}">Add a new product</a>
                </li>
                <li class="nav-item" style="display: flex; align-items: center; padding: 2px;">
                    <a href="{{ route('products.trash') }}" class="nav-link" style="padding-top: 4px; padding-bottom: 4px;">
                        <i class="fa-solid fa-trash" style="margin-right: 1px"></i> Trash
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa-regular fa-user"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="{{ route('signup.get') }}">Register</a>
                        <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
                        <form action="{{ route('user.remove', ['id' => Auth::user()->id]) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="dropdown-item btn btn-link">Delete Account</button>

                        </form>
                        <div class="dropdown-divider"></div>
                    </div>

                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" name="search_name" value="{{ $searchName }}" placeholder="Search Name" aria-label="Search">
                <input class="form-control mr-sm-2" type="search" name="search" value="{{ $search }}" placeholder="Search Quantity" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>

    </nav>

    <!-- content starts -->
    <h1 style="text-align: center; padding: 20px; margin: 0; font-family: 'Jakarta Sans', sans-serif;">
        All Products
    </h1>

    @if (session()->has("success"))
    <div class="d-flex justify-content-center mt-3">
        <div class="alert alert-success alert-dismissible fade show text-center fw-bold" role="alert" style="width: 50%;">
            {{ session()->get("success")}}
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    </div>
    @endif

    @if (session()->has("error"))
    <div class="d-flex justify-content-center mt-3">
        <div class="alert alert-danger alert-dismissible fade show text-center fw-bold" role="alert" style="width: 50%;">
            {{ session()->get("error") }}
            <!-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> -->
        </div>
    </div>
    @endif

    <br>

    <div class="container my-4">
        <div class="row justify-content-center">
            @foreach($products as $product)
            <div class="col-md-4 d-flex align-items-stretch">
                <div class="card mb-5 shadow" style="width: 100%; background-color: #f9f9f9; border-radius: 15px;">
                    <div class="card-body p-4">
                        <h5 class="card-title text-primary">{{$product->name}}</h5>
                        <p class="card-text">{{$product->description}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-light">Quantity: {{$product->qty}}</li>
                        <li class="list-group-item bg-light"> Price: {{$product->text}}</li>

                    </ul>
                    <div class="card-body text-center p-3">
                        <a href="{{route('products.edit', ['product' => $product])}}" class="btn btn-primary btn-sm mx-2">Edit</a>
                        <form action="{{route('products.delete', ['product' => $product])}}" method="post" class="d-inline">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-outline-danger btn-sm mx-2">Delete</button>
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