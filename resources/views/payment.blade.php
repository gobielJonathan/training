@extends('layout.app')

@section('content')
<div class="container pt-5">

    @if (session('success'))
    <div class="alert bg-primary text-white" role="alert">
        <strong>{{session("success")}}</strong>
    </div>
    @endif

    @error('payment_type_id')
    <div class="alert bg-danger text-white" role="alert">
        <strong>{{$message}}</strong>
    </div>
    @enderror

    <h1 class="text-primary">
        @include('layout/back', ['to' => route("home", [], false)])
        <span>Payment</span>
    </h1>

    <form action="{{route('checkout', [],false)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mt-5">
            <div class="input-group input-group-lg mb-3 bg-white box-shadow box-rounded">
                <div class="form-control border-0">
                    <label for="payment" class="text-secondary">Unggah Bukti Pembayaran</label>
                    <input type="file" accept="image/*" name="payment_image" class="d-none" id="payment">
                </div>
                <div class="input-group-append">
                    <button type="submit" class="btn border-left text-secondary">Bayar</button>
                </div>
            </div>
            @error('payment_image')
            <small class="text-danger">{{$message}}</small>
            @enderror
        </div>

        @foreach ($payments as $item)
        <div class="p-4 box-shadow box-rounded mt-4 d-flex align-items-center">
            <div>
                <input type="radio" name="payment_type_id" value="{{$item->id}}">
            </div>
            <div class="w-100 ml-3">
                <div class="payment-header">
                    <div class="container-fluid">
                        <h5 class="text-bold">{{$item->payment_name}}</h5>
                    </div>
                </div>

                <hr>

                <div class="payment-content">
                    <div class="container-fluid">
                        <p>Nomor Akun</p>
                        <p class="text-bold">{{$item->payment_number}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </form>

</div>
@endsection