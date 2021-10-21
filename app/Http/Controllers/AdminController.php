<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\PaymentType;
use App\Models\Stimulus;
use App\Models\StimulusMap;
use App\Models\Training;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {
        return view('by-pass');
    }

    public function showPageAdmin()
    {
        $payment_types = PaymentType::all();
        $training = Training::all();
        $users = User::all();
        return view('admin.index', compact('payment_types', 'training', 'users'));
    }

    public function summaryPeriod(Request $request)
    {
        $from = $request->get('from');
        $to = $request->get('to');

        if ($request->get('stimulus_id')) {
            $stimulus_id = $request->get('stimulus_id');

            $total_cart = 0;
            $total_transaction = Transaction::where("stimulus_id", $stimulus_id)->count();

            $user_ids = StimulusMap::where('stimulus_id', '=', $stimulus_id)->pluck("user_id");
            foreach ($user_ids as $value) {
                $total_cart += Cart::where('user_id', $value)->count();
            }

            return compact('total_cart', 'total_transaction');
        }

        if ($request->get('from') && $request->get('to')) {
            $total_cart = Cart::where('created_at', '<=', $to)->count();
            $total_transaction = Transaction::whereBetween('created_at', [$from, $to])->count();
            return compact('total_cart', 'total_transaction');
        }
    }
}
