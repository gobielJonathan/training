@extends('layout.app')

@section('content')
<div class="container pt-5">
    <h1 class="text-primary">
        @include('layout/back', ['to' => route("home", [], false)])
        <span>Cart</span>
    </h1>

    <div class="row mt-5">
        <div class="col-sm-12 col-md-7">

           @if (count($carts) > 0)
           @foreach ($carts as $item)
           <div class="p-4 box-shadow box-rounded mb-4 cart-item">
               <div class="row">
                   <div class="col-sm-12 col-md-9">
                       <div class="d-flex">
                           <img src="{{$item->training->image}}" class="box-rounded" alt="banner-thumbnail"
                               style="width: 100px;height: 100px;">
                           <div class=" ml-3">
                               <h5>{{$item->training->title}}</h5>
                               <p>Rp.{{$item->training->price}} x {{$item->total}}</p>
                               <h4 class="text-bold">
                                   @php
                                   $st = $item->User->StimulusMap;
                                   @endphp
                                   @if (isset($st))
                                   {{$st->Stimulus->name}}
                                   @endif
                               </h4>
                           </div>
                       </div>
                   </div>
                   <div class="col-3 d-flex">
                       <form action="{{route('removeCart', ['id'=> $item->id], false)}}" method="post" class="h-fit-content mt-auto ml-auto">
                           @csrf
                           <button class="btn btn-remove-cart btn-sm bg-transparent">
                               <i class="fa fa-trash text-secondary" style="font-size: 1.2rem" aria-hidden="true"></i>
                           </button>
                       </form>
                   </div>
               </div>
           </div>
           @endforeach
           @else
              @include('layout/empty')
           @endif


        </div>
        <div class="col-sm-12 col-md-5">
            @php
            $total_price = 0;
            foreach ($carts as $item) {
            $total_price += (int)$item->training->price * $item->total;
            }

            @endphp
            <div class="p-4 box-shadow box-rounded">
                <h5 class="text-bold">Summary</h5>
                <div class="row">
                    <div class="col-4 text-secondary">Subtotal</div>
                    <div class="col-8 text-secondary text-right">Rp.{{$total_price}}</div>
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-4">
                        <h5 class="text-bold">Total Price</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="text-bold text-right">Rp.{{$total_price}}</h5>
                    </div>
                </div>

                @if (count($carts) > 0)
              <a href="{{route('seePayment', [],false)}}">
                <button class="mt-3 btn w-100 bg-primary text-white">
                    Checkout
                </button>
            </a>
              @endif
            </div>
        </div>
    </div>
</div>
@endsection
