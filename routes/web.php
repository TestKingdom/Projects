<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;


Route::get('/', function () {
    return redirect('/login');
});

//user

Route::get('/login',function(){
    return view('login');
})->name('login');
Route::post('/login',[Usercontroller::class, 'login']);
Route::get('/register',function()
{
    return view('register');
});
Route::post('/register',[Usercontroller::class, 'register']);

Route::get('/home',[Usercontroller::class, 'home'])->middleware('auth')->name('home');
Route::get('/logout',[Usercontroller::class, 'logout'])->middleware('auth')->middleware('auth');;

//products
Route::get('/createproduct',[ProductsController::class, 'createproduct'])->middleware('auth');
Route::post('/createproduct',[ProductsController::class, 'submitproduct']);
Route::get('/updateproduct/{product}',[ProductsController::class,'getupdateProduct' ])->middleware('auth');
Route::put('/updateproduct/{product}',[ProductsController::class,'submitupdateProduct' ]);
Route::delete('/deleteproduct/{product}',[ProductsController::class,'deleteProduct' ])->middleware('auth');

//search
Route::get('/search',[ProductsController::class, 'search']);