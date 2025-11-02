<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    //
    public function createproduct()
    {
        return view('createproduct');
    }

    public function submitproduct(Request $req)
    {
        $fields=$req->validate(
            [
                'product_name'=>'required|alpha_num',
                'quantity'=>'required|integer|min:1',
                'price'=>'required|numeric|min:0.01',
                'product_image'=>'image|max:3000|mimes:jpg,png,jpeg,webp'
            ]);
        
        
        if($req->hasFile('product_image')) 
        {
            $filname=$fields['product_name'].'_'.uniqid().'_'.date('d_m_Y_H_i_s').'.'.$req->file('product_image')->extension();
            $path= $req->file('product_image')->storeAs('photos',$filname,'public');
            $fields['product_image']=$path;
        }
        $fields['product_name']=strip_tags($fields['product_name']);
        $fields['added_date']=now('Asia/Calcutta');
      
        // dd($fields);
        $newprod=Product::create($fields);
        // dd($newprod);
        

        flash()->options([
        'timeout' => 2500,

        ])->success(ucfirst($newprod->product_name).' has been added',[],'Product Added');
        return redirect('/home');
    }

    function getupdateProduct(Product $product) {

       
        
        return view('updateproduct',['product'=>$product]);
    }

    
    function deleteProduct(Product $product, Request $request) {
        // dd($request->confirm_code);
        // dd($request->confirm_code != $product->id);
         if ($request->confirm_code != $product->id) {
        return abort(401,'Not authorized');
    }

        if($product->product_image)
        {
               Storage::disk('public')->delete($product->product_image);
        }
     
        $product->delete();

             flash()->options([
        'timeout' => 2500,

        ])->success('Action completed');
        
        return redirect('/home');
       
    }

    function submitupdateProduct(Product $product, Request $req) {
        
         $products = Product::findOrFail($product->id);
         

       $fields=$req->validate(
            [
                'product_name'=>'required',
                'quantity'=>'required|integer|min:1',
                'price'=>'required|numeric|min:0.01',
                'product_image'=>'image|max:3000|mimes:jpg,png,jpeg,webp'
            ]);

        $fields['product_name']=strip_tags($fields['product_name']);
        $fields['added_date']=now('Asia/Calcutta');


        $product->product_name=$fields['product_name'];
        $product->quantity=$fields['quantity'];
        $product->price=$fields['price'];


            if($req->hasFile('product_image')) 
        {
            $filname=$fields['product_name'].'_'.uniqid().date('d_m_Y_H_i_s').'.'.$req->file('product_image')->extension();
            $path= $req->file('product_image')->storeAs('photos',$filname,'public');
            $fields['product_image']=$path;

            if($product->product_image)
            {
                Storage::disk('public')->delete($product->product_image);
            }
             
            $product->product_image=$fields['product_image'];
        }

        else if($req->clear_image)
        {   
            Storage::disk('public')->delete($product->product_image);
            $product->product_image=null;
        }

        $product->save();

         flash()->options([
        'timeout' => 2500,

        ])->success('Product updated succesfully.', [],'Product Updated');

        return redirect('/home');
    }

    function search(Request $req)
    {
        if($req->ajax())
        {
            $output='';
            $product=Product::where('product_name','LIKE','%'.$req->search.'%')->get();
            
            if($product->isEmpty())
            {
                
                $output='<tr text-align:right>
                    <td colspan="7" class="text-center text-muted" >No products found.</td>
                </tr>';
               
            }

            
            else
            {
               foreach($product as $product)
                {
                    $output.='<tr>
                    
                    <td>'. $product->id.'</td>
                    <td>
                     
                        
                <img src="'. 
                ($product->product_image == null 
                            ? asset('storage/photos/default.jpg') 
                            : asset('storage/' . $product->product_image)) . 
                    '" alt="' . $product->product_name . '" width="150" height="150" class="rounded">
                </td>
                <td>' . $product->product_name . '</td>
                <td><strong>' . number_format($product->price,2)  . '</strong></td>
                <td>' . $product->quantity . '</td>
                
                <td>' . $product->added_date->format('d/F/Y') . '</td>
                <td>
                    <a href="/updateproduct/' . $product->id . '" class="btn btn-secondary">Edit</a>
                    <form action="/deleteproduct/'. $product->id .'" method="POST"><br> ' . csrf_field() . ' ' . method_field("DELETE") . ' <input type="hidden" name="confirm_code" value="'. $product->id.'"> <button class="btn btn-danger" onclick="return confirm(\'Confirm for deletion?\')">Delete</button> </form>
                </td>
            </tr>';
                }
            }

           return response()->json($output); 
        }
          
    }
}
