@extends('layout.app')

@section('content')
<div class="container pt-5">
    <h5 class="text-bold">Sign in</h5>
    <p class="my-3">Don't have account? <a class="ml-1" href="{{route('register', [], false)}}">Sign Up</a></p>


    <form action="{{route('loginAs', [], false)}}" method="post">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control @if ($errors->has('email')) is-invalid @endif" name="email" id="email" placeholder="Email">
            <small class="form-text text-muted">Example : John Doe@gmail.com</small>
            @if($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
            @endif

        </div>

        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>

        @if($errors->has('password'))
        <div class="invalid-feedback">
            {{ $errors->first('password') }}
        </div>
        @endif


        <button class="btn w-100 bg-primary text-white">
            Sign In
        </button>
    </form>
</div>
@endsection