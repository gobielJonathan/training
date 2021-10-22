<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $carts = Cart::with(['User.StimulusMapOnGoing.Stimulus.Training', 'Training'])
        ->where('user_id', Auth::id())
        ->get();
        // return (json_encode($carts));
        return view('cart', compact('carts'));
    }

    public function add(Request $request, $id, $training_id){
        $c = Cart::find($id);
        $c->total++;
        $c->save();
        $t = Training::find($training_id);
        return response()->json([
            'status' => 'ok',
            'total' => (int)$c->total * (int) $t->price
        ]);
    }

     public function decrease(Request $request, $id,$training_id){
        $c = Cart::find($id);
        if($c->total - 1 > 0){
            $c->total--;
        $c->save();
 $t = Training::find($training_id);
        return response()->json([
            'status' => 'ok',
            'total' => (int)$c->total * (int) $t->price
        ]);
        }
        return null;
    }

    public function buy(Request $request, $banner_id)
    {
        $c = Cart::where([
            ['user_id', '=', Auth::id()],
            ['training_id', '=', $banner_id],
        ])->first();

        if ($c == null) {
            $c = new Cart;
            $c->training_id = $banner_id;
            $c->user_id = Auth::id();
             $c->total = 1;
        } 
        $c->save();
        return redirect()->route('seeCart');
    }

    public function remove(Request $request, $id)
    {
        Cart::find($id)->delete();
        return back();
    }

    public function instantCart(Request $request, $banner_id)
    {
        $c = Cart::where([
            ['user_id', '=', Auth::id()],
            ['training_id', '=', $banner_id],
        ])->first();

        if ($c == null) {
            $c = new Cart;
            $c->training_id = $banner_id;
            $c->user_id = Auth::id();
        } else {
            $c->total++;
        }
        $c->save();
        return redirect()->route('seePayment');
    }
}
