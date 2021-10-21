<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{
    public function index(){
        $payments = PaymentType::all();
        return view('payment', compact('payments'));
    }

    public function add(Request $request){
        $d = new PaymentType;
        $d->payment_name = $request->get('name');
        $d->payment_number = $request->get('number');
        $d->save();
        return redirect()->back();
    }

    public function remove(Request $request){
        PaymentType::find($request->get('id'))->delete();
        return 'ok';
    }
}
