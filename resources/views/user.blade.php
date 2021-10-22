@extends('layout.app')

<style>
    .bg-c-lite-green {
        background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
        background: linear-gradient(to right, #ee5a6f, #f29263);
    }

    .tableFixHead {
        overflow: auto;
        height: 300px;
    }

    .tableFixHead thead th {
        position: sticky;
        top: -1px;
        z-index: 1;
        background-color: white;
    }

    .tableFixHead tbody th {
        position: sticky;
        left: 0;
    }
</style>
@section('content')
<div class="w-100 h-100 bg-primary pt-5 d-flex flex-column justify-content-center align-items-center">
    <div class="row mx-0 box-shadow w-100 h-100" style="max-width: 800px;max-height: 400px;">
        <div
            class="bg-c-lite-green box-top-left-rounded box-bottom-left-rounded h-100 text-white col-sm-12 col-md-4 d-flex align-items-center justify-content-center flex-column">
            <img style="width: 128;height: 128;" src="{{asset('/assets/icons/personal.svg')}}" alt="person-icon">
        </div>
        <div class="col-sm-12 col-md-8 bg-white p-5 box-top-right-rounded box-bottom-right-rounded">
            <h5 class="text-bold">
                @include('layout/back', ['to' => route("home", [], false)])
                <span>Information</span>
            </h5>
            <hr>
            <div class="row">
                <div class="col-6">
                    <h5 class="text-bold">Email</h5>
                    <p class="text-secondary">{{$user->email}}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="box-shadow mb-5 w-100 h-100 bg-white box-rounded mt-4" style="max-width: 800px;max-height: 400px;">
        <h5 class="text-bold p-2 border-bottom">
            <span>Histories</span>
        </h5>

       @if (count($transactions) > 0)
       <div class="tableFixHead">
        <table class="table">
            <thead>
                <tr>
                    <th>Training</th>
                    <th>Payment</th>
                    <th>User</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $item)
                <tr>
                    <td>
                        @if (isset($item->Training))
                        <img src="{{$item->Training->image}}" style="width: 100px;" alt="training-thumbnail" /> <br />
                        <span>{{$item->Training->title}}</span>
                        @else
                            <span>-</span>
                        @endif
                    </td>
                    <td>
                        @if (isset($item->Payment))
                        {{$item->Payment->payment_name}}({{$item->Payment->payment_number}}) <br />
                        @endif
                        <img src='{{$item->payment_image}}' style="width: 100px;" alt="training-thumbnail" /> <br />
                        <span>{{$item->created_at}}</span>
                    </td>
                    <td>
                        Email : {{$item->User->email}} <br />
                        Address : {{$item->User->address}} <br />
                    </td>
                    <td>{{$item->status == App\Models\Transaction::PENDING ? "Pending" : "Approved"}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
       </div>
       @else
           
       @endif
    </div>
</div>
@endsection