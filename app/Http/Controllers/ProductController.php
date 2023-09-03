<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   
    public function index()
    {
        return view('products.index', ['products'=>Product::orderBy('created_at', 'DESC')->get()]);
    }

   
    public function create()
    {
        return view('products.forms.create');
    }

   
    public function store(StoreProductRequest $request)
    {
        Product::create($request->all());
        return redirect()->route('products.create')->with('success', 'Product added successfully');
    }

   
    public function show(Product $product)
    {
        return view('products.show', ['product'=>$product]);
    }

  
    public function edit(Product $product)
    {
        return view('products.forms.edit', ['product'=>$product]);
    }

    
    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product edited successfully');

    }

   
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    public function search(Request $request){
        $products = Product::search($request->term)->get();
        return view('products.index', ['products'=>$products]);
    }
}
