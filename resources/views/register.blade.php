@extends('layout.app')

@section('content')
<div class="container pt-5">
    <h5 class="text-bold">Join Now!</h5>

    <p class="my-3">Already Have Account? <a class="ml-1" href="{{route('login', [], false)}}">Sign In</a></p>


    <form action="{{route('addUser', [], false)}}" method="post">
      @csrf
        <div class="form-group">
          <input value="{{old('email')}}" type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email">
          <small id="emailHelpId" class="form-text text-muted">Example : John Doe@gmail.com</small>
          @error('email')
          <div class="invalid-feedback">
            {{ $message }}
        </div>    
          @enderror

        </div>

        <div class="form-group">
          <input value="{{old('password')}}" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  placeholder="Password">
          @error('password')
          <div class="invalid-feedback">
            {{ $message }}
        </div>    
          @enderror

</div>

        <button class="btn w-100 bg-primary text-white">
            Sign Up
        </button>
    </form>
</div>
@endsection