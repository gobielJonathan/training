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
                   <div class="col-12">
                       <div class="d-flex">
                           <div class="col-md-12 col-lg-7">
                               @if(isset($item->User->StimulusMapOnGoing))
                                <img src="{{$item->User->StimulusMapOnGoing->stimulus->training->image}}" class="box-rounded w-100 h-100" alt="banner-thumbnail"
                                style="max-height:500px">
                            @else
                                <img src="{{$item->training->image}}" class="box-rounded w-100 h-100" alt="banner-thumbnail"
                                style="max-height:500px">
                            @endif
                           </div>
                           <div class="col-md-12 col-lg-5">
                               @if(isset($item->User->StimulusMapOnGoing))
                                @php
                                    $ls = $item->User->StimulusMapOnGoing->Stimulus;
                                @endphp
                                <h3 class="text-bold text-break">{{$ls->training->title}}</h3>
                                <h5>{{$ls->name}}</h5>
                                <p>Rp.{{$ls->training->price}} <br>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <button type="button" class="btn btn-sm"  data-type="minus" data-id="{{$item->id}}" data-training="{{$ls->training->id}}">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" id="qty-{{$item->id}}" class="form-control input-number" value="{{$item->total}}" min="1">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm" data-type="plus" data-id="{{$item->id}}" data-training="{{$ls->training->id}}">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </span>
                                </div>
                               @elseif($item->training)
                                <h3 class="text-bold">{{$item->training->title}}</h3>
                                <p>Rp.{{$ls->training->price}}</p> <br>
                                <div class="input-group">
                                    <span class="input-group-prepend">
                                        <button type="button" class="btn btn-sm"  data-type="minus" data-id="{{$item->id}}" data-training="{{$item->training->id}}">
                                            <span class="fa fa-minus"></span>
                                        </button>
                                    </span>
                                    <input type="text" id="qty-{{$item->id}}" class="form-control input-number" value="{{$item->total}}" min="1">
                                    <span class="input-group-append">
                                        <button type="button" class="btn btn-sm" data-type="plus" data-id="{{$item->id}}" data-training="{{$item->training->id}}">
                                            <span class="fa fa-plus"></span>
                                        </button>
                                    </span>
                                </div>
                               @endif
                           </div>
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
                    <div class="col-8 text-secondary text-right text-price">Rp.{{$total_price}}</div>
                </div>

                <hr class="my-4">

                <div class="row">
                    <div class="col-4">
                        <h5 class="text-bold">Total Price</h5>
                    </div>
                    <div class="col-8">
                        <h5 class="text-bold text-right text-price">Rp.{{$total_price}}</h5>
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

@section("script")
<script>

    function updateValueQty(id, increment = false){
        if(increment)
        $(`#qty-${id}`).val(+$(`#qty-${id}`).val() + 1)
        else 
        $(`#qty-${id}`).val(+$(`#qty-${id}`).val() - 1)
    }

    $("[data-type='plus']").click(function() {
        const id = $(this).data('id')
        const training_id = $(this).data('training')
        $.ajax({
            url :`/cart/add/${id}/${training_id}`,
            method : "POST",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        }).then(res => {
            if(res?.status == "ok"){
                const {total} = res
                $(".text-price").text(total)
                updateValueQty(id, true)
            }
        })
    })

     $("[data-type='minus']").click(function() {
        const id = $(this).data('id')
        const training_id = $(this).data('training')
        $.ajax({
            url :`/cart/remove/${id}/${training_id}`,
            method : "POST",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            }
        }).then(res => {

            if(res?.status == "ok"){
                const {total} = res
                $(".text-price").text(total)
                updateValueQty(id)
            }
        })
    })
</script>
@endsection

