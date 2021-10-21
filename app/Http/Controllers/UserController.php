<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //

    public function index(){
        $user = Auth::user();
        $transactions = Transaction::where('user_id', Auth::id())->get();
        return view('user', compact('user','transactions'));
    }
    public function remove(Request $request){
        User::where('id', $request->get('id'))->delete();
        return redirect()->back();
    }
}
