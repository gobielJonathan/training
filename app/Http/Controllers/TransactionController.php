<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\StimulusMap;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add(Request $request)
    {
        $carts = Cart::where('user_id', Auth::id());
        $stimulus_id = StimulusMap::where('user_id', Auth::id())->pluck('stimulus_id')->first();
        $validator = Validator::make($request->all(), [
            'payment_type_id' => 'required',
            'payment_image' => 'required'
        ], [
            'payment_type_id.required' => "Payment must be required",
            'payment_image.required' => "Payment Image must be required",
        ]);
        if ($validator->fails()) return back()->withErrors($validator);

        foreach ($carts->get() as $key => $value) {
            $d = new Transaction;
            $d->training_id = $value['training_id'];
            $d->user_id = $value['user_id'];
            $d->total = $value['total'];
            $d->payment_type_id = (int)$request->get('payment_type_id');

            $image_path = Storage::put('public/payment', $request->file('payment_image'));
            $d->payment_image = Storage::url($image_path);

            $d->status = Transaction::PENDING;
            $d->stimulus_id = (int)$stimulus_id;
            $d->save();
        }
        
        $carts->delete();
        return back()->with(['success' => 'success upload payment']);
    }

    public function get()
    {
        $data = Transaction::with([
            'Training', 'User', 'Payment'
        ])->where('status', Transaction::PENDING)->get();
        return $data;
    }

    public function accept(Request $request)
    {
        Transaction::find($request->get('id'))->update([
            'status' => Transaction::APPROVED
        ]);
        return true;
    }
}
