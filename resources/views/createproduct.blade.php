@extends('layouts.app')
@include('layouts.nav')
@section('createproduct')
@section('scripts')
<script src="{{ asset('js/image.js') }}">
</script>
@endsection
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">

        
            <h3 class="mb-4 text-center">Add New Product</h3>

       
            <form action="/createproduct" method="POST" enctype="multipart/form-data">
          
                @csrf

             
                <div class="mb-3">
                    <label for="product_name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="product_name" placeholder="Enter product name" name="product_name" value="{{ old('product_name') }}" required>
                    @error('product_name')
                        <p class="m-0 small" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                        <div class="mb-3 text-center image" style="display:none;">
                        <img id="imgPreview" class="rounded" width="150" height="150" src="">
                        </div>

                 <div class="mb-3">
                    <label for="product_image" class="form-label">Product Image</label>
                    <input type="file" class="form-control" id="product_image" accept="image/*" name="product_image" value="{{ old('product_image') }}" >
                      @error('product_image')
                        <p class="m-0 small" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                  <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="quantity" placeholder="Enter quantity" name="quantity" value="{{ old('product_quantity') }}" required>
                      @error('quantity')
                        <p class="m-0 small" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

                
               

               
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" placeholder="Enter price" name="price" value="{{ old('product_price') }}" step="0.01" required>
                      @error('price')
                        <p class="m-0 small" style="color: red">{{ $message }}</p>
                    @enderror
                </div>

           
                <div class="d-flex justify-content-between mt-4">
                    <a href="/home" class="btn btn-secondary">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Add product"></input>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
    var unsaved=false;
   $(document).ready(function()
   {
    $('input').on('change',function(){

        unsaved=true;
    });

    $(window).on('beforeunload',function(event)
    {
        if(unsaved)
        {
             event.returnValue='a';
            return 'a';
        }
    });

    $('form').on('submit',function()
    {
        unsaved=false;
    });

   });
</script>
@endsection