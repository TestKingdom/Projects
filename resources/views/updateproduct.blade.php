@extends('layouts.app')
@include('layouts.nav')
@section('createproduct')
@section('scripts')
<script src="{{ asset('js/image.js') }}"></script>
@endsection
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

        
            <h3 class="mb-4 text-center">Update Product Details</h3>

       
            <form action="/updateproduct/{{ $product->id }}" method="POST" enctype="multipart/form-data">
               
                @csrf
                @method('PUT')
             
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="product_name" placeholder="Enter product name" name="product_name" value="{{ $product->product_name }}" required>
                    @error('product_name')
                        <p class="m-0 small" style="color: red">{{ $message }}</p>
                    @enderror
                </div>
              
        @if($product->product_image)
    <div class="mb-3 text-center image">
        <img id="imgPreview" src="{{ asset('storage/' . $product->product_image) }}" 
             alt="Product Image" class="rounded mb-2" width="200" height="200">
        
        <div class="  align-items-center justify-content-center">
            <input class="form-check-input me-2" type="checkbox" name="clear_image" id="clear_image" value="1">
            <label class="form-check-label mb-0" for="clear_image">
                Remove current image
            </label>
        </div>
    </div>
@else
    <div class="mb-3 text-center image" style="display:none;">
        <img id="imgPreview" class="rounded" width="150" height="150">
    </div>
@endif

                 <div class="mb-3">
                    <label for="product_image" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="product_image" accept="image/*" name="product_image" value="{{ $product->product_image }}" >
                      @error('product_image')
                        <p class="m-0 small" style="color: red">{{ $message }}</p>
                    @enderror
                    
                </div>

                     <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="{{ $product->price }}" step="0.01" required>
                      @error('price')
                        <p class="m-0 small" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                  <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" value="{{$product->quantity }}" required>
                      @error('quantity')
                        <p class="m-0 small" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                
               

               
           

           
                <div class="d-flex justify-content-between mt-4">
                    <a href="/home" class="btn btn-secondary">Cancel</a>
                   <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>

        </div>
    </div>
</div>
<script>






</script>
@endsection