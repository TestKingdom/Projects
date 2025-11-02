@extends('layouts.app')
@include('layouts.nav')

@section('home')
@section('scripts')
<script src="{{ asset('js/search.js') }}"></script>

@endsection
<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Product List</h3>
         
        <a href='/createproduct' class="btn btn-primary">
            Add New Product
        </a>
       
    </div>
    <div class="col-md-8">

               <div class="alert alert-info" role="alert">
        <strong>Total Inventory Value: Rs  {{ number_format($total, 2) }}</strong>
    
    </div>
    </div>
     <div class="col-md-4">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="search"
                   placeholder="Search products" name="search" required>
        </div>

        <div class="d-flex justify-content-between">
            
        </div>
      
</div>

     
    <table class="table  table-hover align-middle">
        <thead class="table-secondary">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
             
                <th>
                    @if($products->isNotEmpty())
                <a href="{{ route('home', [
                        'sort_by' => 'added_date',
                        'sort_order' => ($sortOrder === 'asc') ? 'desc' : 'asc'
                    ]) }}" class="text-decoration-none text-dark sort-link" >
                    @endif
                        Added Date
                            @if($products->isNotEmpty())
                             @if($sortOrder === 'asc' )
                                <span>&#8593;</span>
                            @else
                                <span>&#8595;</span>
                        
                          
                            @endif
                            @endif
                       
                    </a>
                </th>
                
                <th>Action</th>
            </tr>
        </thead>
       
        <tbody id="actual" class="actual" >
            @unless ($products->isEmpty())
          
      
            @foreach ($products as $product)
            
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>


                                <img src="{{ $product->product_image == null 
                                ? asset('storage/photos/default.jpg') 
                                : asset('storage/' . $product->product_image) }}" 
                        alt="{{ $product->product_name }}" width="150" height="150" class="rounded">
                        
                    
                    </td>
                    <td>{{ $product->product_name }}</td>
                     <td><strong>{{number_format($product->price,2)  }}</strong></td>
                    <td>{{ $product->quantity }}</td>
                    {{-- <td>{{number_format($product->price*$product->quantity,2)  }}</td> --}}
                    <td>{{($product->added_date)->format('d/F/Y') }}</td>
                    <td><a href="/updateproduct/{{ $product->id }}" class="btn btn-secondary">Edit</a>
                        <form action="/deleteproduct/{{ $product->id }}" method="POST"><br>
                            @method('DELETE')
                            @csrf
                    <input type="hidden" name="confirm_code" value="{{ $product->id }}">
                     <button class="btn btn-danger" id="delete" >Delete</button> 
                    </form>
                    </td>
                </tr>
                
              
                
              
                    
                
               
                    {{-- {{$rowtotal=($product->price*$product->quantity)}}
                    {{$total += $rowtotal}} --}}
             
                    

         
             
            @endforeach
            @else  
            <tr>
                    <td colspan="7" class="text-center text-muted">No products found.</td>
                </tr>
             @endunless
             
        </tbody>
         <tbody id="search-body" class="search-body">
            
        </tbody>
    </table>

    <div class="page">
    {{ $products->links('pagination::bootstrap-5') }}
    </div>
    {{-- @php
        dd($products)
    @endphp --}}
</div>

<script>
    document.addEventListener("DOMContentLoaded",function()
    {
        document.getElementById('delete').onclick=function()
        {
            return confirm("Confirm deletion");
        } 

        
    });

</script>
@endsection
