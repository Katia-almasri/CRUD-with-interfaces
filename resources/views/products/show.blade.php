@extends('products.layout')
@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="text-center">
                <img class="img-fluid rounded-circle" src="{{ asset('assets/img/01.jpg') }}" alt="Product Image" />
            </div>
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">Category: perfume{{ $product->category }}</p>
            <p class="lead">Price: 1000${{ $product->price }}</p>
            <p>Product Details:</p>
            <p>{{ $product->details }}</p>
            <div class="mb-3">
                <button class="btn btn-primary">Add to Cart</button>
            </div>
        </div>
    </div>
</div>

@endsection
