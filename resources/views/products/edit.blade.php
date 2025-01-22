<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="font-family: 'Jakarta Sans', sans-serif;">

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

            </ul>
        </div>
    </nav>
    <br>
    <div class="row mt-3">
        <div class="col-8 offset-2">
            <h1 style="text-align:center; padding:2px">Edit Details of the Product</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="post" action="{{route('products.update', ['product' => $product])}}">
                @csrf
                @method('put')


                <div class="form-group mb-3">
                    <label for="name" style="font-weight: bold;">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$product->name}}" placeholder="Enter your name" required>
                </div>
                <div class="form-group mb-3">
                    <label for="qty" style="font-weight: bold;">Quantity</label>
                    <input type="number" class="form-control" name="qty" id="qty" value="{{$product->qty}}" placeholder="Enter the quantity" required>
                </div>
                <div class="form-group mb-3">
                    <label for="price" style="font-weight: bold;">Price</label>
                    <input type="number" class="form-control" name="price" id="price" value="{{$product->text}}" placeholder="Price of the product" required>
                </div>
                <div class="form-group mb-3">
                    <label for="description" style="font-weight: bold;">Description</label>
                    <textarea class="form-control" id="description" name="description" value="{{$product->description}}" rows="3" max="50"></textarea>
                </div>

                <button type="submit" class="btn btn-outline-success">Submit</button>

            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>