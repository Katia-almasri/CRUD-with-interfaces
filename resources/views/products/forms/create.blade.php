@extends('products.layout')
@section('content')
<div class="container px-5">
    <div class="container mt-4">
        <h2>Add Product</h2>
        <form action="{{ route('products.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Product Name:</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter product name"
                    value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="details">Product Details:</label>
                <textarea class="form-control" id="details" name="details" rows="4" placeholder="Enter product details"
                    value="{{ old('details') }}"></textarea>
                @error('details')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container mt-4">
        <div class="d-flex justify-content-end mt-2">
            <a href="{{ route('products.index') }}" class="btn btn-success">Back</a>
        </div>
    </div>
</div>

@endsection
