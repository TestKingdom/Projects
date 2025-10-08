@extends('layouts.app')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-5 p-4 shadow-sm border rounded bg-white">
        <h2 class="text-center mb-4">Login</h2>

        <form action="/login" method="post">
            @csrf

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                @error('email')
                    <p class="m-0 small text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                @error('password')
                    <p class="m-0 small text-danger">{{ $message }}</p>
                @enderror
                 @if(session()->has('invalid'))
            <p class="mb-1 small text-danger">{{ session('invalid') }}</p>
            @endif
            </div>
           
            <div class="mb-3 text-center">
                <a href="/register">Not having an account? Register from here</a>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            
        </form>
    </div>
</div>
