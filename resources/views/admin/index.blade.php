@extends('layout.app')

@section('content')
<div class="row container mx-auto pt-5">
    <div class="col-sm-12 col-md-4 nav flex-column nav-pills" id="v-pills-tab" role="tablist"
        aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-payment-tab" data-toggle="pill" href="#v-pills-payment" role="tab"
            aria-controls="v-pills-payment" aria-selected="true">Payment</a>
        <a class="nav-link" id="v-pills-stimulus-tab" data-toggle="pill" href="#v-pills-stimulus" role="tab"
            aria-controls="v-pills-stimulus" aria-selected="false">Stimulus</a>
        <a class="nav-link" id="v-pills-training-tab" data-toggle="pill" href="#v-pills-training" role="tab"
            aria-controls="v-pills-training" aria-selected="false">Training</a>
        <a class="nav-link" id="v-pills-user-tab" data-toggle="pill" href="#v-pills-user" role="tab"
            aria-controls="v-pills-user" aria-selected="false">User</a>

        <a class="nav-link" id="v-pills-periode-tab" data-toggle="pill" href="#v-pills-periode" role="tab"
            aria-controls="v-pills-periode" aria-selected="false">Periode</a>

            <a class="nav-link" id="v-pills-transaction-tab" data-toggle="pill" href="#v-pills-transaction" role="tab"
            aria-controls="v-pills-transaction" aria-selected="false">Transaction</a>
    </div>
    <div class="col-sm-12 col-md-8 tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-payment" role="tabpanel"
            aria-labelledby="v-pills-payment-tab">
            @include('admin/payment')
        </div>
        <div class="tab-pane fade" id="v-pills-stimulus" role="tabpanel" aria-labelledby="v-pills-stimulus-tab">
            @include('admin/stimulus')
        </div>
        <div class="tab-pane fade" id="v-pills-training" role="tabpanel" aria-labelledby="v-pills-training-tab">
            @include('admin/training')
        </div>

        <div class="tab-pane fade" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
            @include('admin/user')
        </div>

        <div class="tab-pane fade" id="v-pills-periode" role="tabpanel" aria-labelledby="v-pills-periode-tab">
            @include('admin/periode')
        </div>

        <div class="tab-pane fade" id="v-pills-transaction" role="tabpanel" aria-labelledby="v-pills-transaction-tab">
            @include('admin/transaction')
        </div>
    </div>

</div>
@endsection