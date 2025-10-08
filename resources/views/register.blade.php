@extends('layouts.app')

@section('register')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-5 p-4 shadow-sm border rounded bg-white">
        <h2 class="text-center mb-4">Registration</h2>

        <form action="/register" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                    <p class="m-0 small text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" name="email">
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
            </div>

            <div class="mb-3 text-center">
                <a href="/login">Do you have an account? Login from here</a>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </form>
    </div>
</div>


@endsection