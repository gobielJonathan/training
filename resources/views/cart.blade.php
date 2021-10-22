@extends('layout.app')

@section('content')
<div class="container pt-5">
    <h1 class="text-primary">
        @include('layout/back', ['to' => route("home", [], false)])
        <span>Cart</span>
    </h1>

    <div class="row mt-5">
        <div class="col-md-12 col-lg-8">

           @if (count($carts) > 0)
           @foreach ($carts as $item)
           <div class="p-4 box-shadow box-rounded mb-4 cart-item">
               <div class="row">
                   <div class="col-md-12 col-lg-10">
                       <div class="d-flex">
                           <div class="col-md-12 col-lg-8">
                               @if(isset($item->User->StimulusMapOnGoing))
                                <img src="{{$item->User->StimulusMapOnGoing->stimulus->training->image}}" class="box-rounded w-100 h-100" alt="banner-thumbnail"
                                style="max-height:500px">
                            @else
                                <img src="{{$item->training->image}}" class="box-rounded w-100 h-100" alt="banner-thumbnail"
                                style="max-height:500px">
                            @endif
                           </div>
                           <div class="col-md-12 col-lg-4">
                               @if(isset($item->User->StimulusMapOnGoing))
                                @php
                                    $ls = $item->User->StimulusMapOnGoing->Stimulus;
                                @endphp
                                <h3 class="text-bold">{{$ls->training->title}}</h3>
                                <h5>{{$ls->name}}</h5>
                                <p>Rp.{{$ls->training->price}} x 

                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number"  disabled="disabled" data-type="minus" data-id="{{$t->id}}">
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" id="qty-{{$t->id}}" class="form-control input-number" value="{{$t->total}}" min="1">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" data-type="plus" data-id="{{$t->id}}">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                                </div>
                                </p>
                               @elseif($item->training)
                                <h3 class="text-bold">{{$item->training->title}}</h3>
                                <p>Rp.{{$item->training->price}} x 
                                      <div class="input-group">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number"  disabled="disabled" data-type="minus" data-id="{{$t->id}}">
                                            <span class="glyphicon glyphicon-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" id="qty-{{$t->id}}" class="form-control input-number" value="{{$t->total}}" min="1">
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default btn-number" data-type="plus" data-id="{{$t->id}}">
                                            <span class="glyphicon glyphicon-plus"></span>
                                        </button>
                                    </span>
                                </div>
                                </p>
                               @endif
                           </div>
                       </div>
                   </div>
                   <div class="col-2 d-flex">
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
        <div class="col-md-12 col-lg-4">
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
