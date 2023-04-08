@extends('layout')
@section('header')
    Login
@endsection
@section('content')
@include('error', ['errors' => $errors])
<form action="/access/auth" method="POST">
    @csrf
    <div class="row">
        <div class="col col-12">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col col-12">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="col col-12 mt-2">
            <p>Forgot password? <strong><a href="">Click here</a></strong></p>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 mt-2">
            <button class="btn btn-success">Login</button>
           <a href="{{ route('register_user') }}" class="btn btn-primary">Register</a>
        </div>
    </div>
    
</form>
@endsection