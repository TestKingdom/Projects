<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;

use Flasher\Prime\FlasherInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class Usercontroller extends Controller
{
    //

    public function register(Request $req)
    {
        $fields=$req->validate(
          [
            "name"=>['required','min:3',Rule::unique('users','name')],
            "email"=>['required','email',Rule::unique('users','email')],
            "password"=>['required','min:8']
            ]);

      
           $user= User::create($fields);
            Auth::login($user);
             flash()->options([
        'timeout' => 2500
        ])->success('Registration Succesful. You are now logged in');

            return redirect('/home');
       
    
    }
    public function login(Request $req)
    {
         $fields=$req->validate(
          [
            "email"=>['required'],
           
            "password"=>['required']
            ]);

        $fields['email']=strip_tags($fields['email']);

        if (Auth::attempt($fields))
        {
            $req->session()->regenerate();
            flash()->options([
        'timeout' => 2500,
        'position'=>'top-center',
        'animation'=>''
        ])->success('Your are logged in.', [],'Logged in');
          return redirect('/home');
               
        }
        else
        {
              return redirect('/login')->with('invalid','Invalid login credentials');
        }
            
        


    }
     public function home(Request $req)
    {
        if(Auth::check())
        {   
            

            $totalInventoryValue = Product::select(DB::raw('SUM(quantity * price) as total'))
            ->value('total');

            // dd($totalInventoryValue);

            $sortBy = $req->get('sort_by', 'added_date');
            $sortOrder = $req->get('sort_order', 'desc');

            $products=Product::orderBy($sortBy,$sortOrder)->paginate(5);

            return view('home',['products'=>$products,'sortOrder'=>$sortOrder,'sortBy'=>$sortBy,'total'=>$totalInventoryValue]);
           
        }
        else{
       
            return redirect('/login'); 
        }
    }

    public function logout(Request $req)
    {
       Auth::logout();
       $req->session()->invalidate();
       $req->session()->regenerateToken();

         flash()->options([
        'timeout' => 2500,

        ])->info('You are now logged out');
         


        return redirect('/login');

    }

        
}

