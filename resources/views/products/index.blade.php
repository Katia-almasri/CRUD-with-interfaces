@extends('products.layout')
@section('content')
<section>
       <div class="container px-5">
           <div class="row gx-5 align-items-center">
               <div class="col-lg-12">
                     <br>
                   <div class="mb-3">
                       <a href="{{route('products.create')}}" class="btn btn-success">Create Product</a>
                   </div>
                   @isset($products)
                   @if (count($products) == 0)
                   <div class="alert alert-warning">
                     <strong>Warning:</strong> No records found.
                 </div>
                 @else
                 <table class="table table-striped">
                     <thead>
                         <tr>
                             <th scope="col">#</th>
                             <th scope="col">name</th>
                             <th scope="col">details</th>
                             <th scope="col">actions</th>
                         </tr>
                     </thead>
                     <tbody>
                          
                         @foreach ($products as $_product)
                         <tr>
                             <th scope="row">{{ $_product->id }}</th>
                             <td>{{ $_product->name }}</td>
                             <td>{{ $_product->details }}</td>
                             <td>
                                 <form method="POST" action="{{ route('products.destroy', $_product) }}">
                                        <a href="{{route('products.show', $_product)}}" class="btn btn-primary mr-2">show</a>
                                        <a href="{{route('products.edit', $_product)}}" class="btn btn-warning mr-2">edit</a>
     
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mr-2" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>
                             </td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>  
                   @endif

                         
                    @endisset
                   
               </div>
           </div>
       </div>
   </section>
   
@endsection
