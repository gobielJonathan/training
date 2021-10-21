<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'address' => 'required',
            'telephone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $user = new User;
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->address = '';
        $user->telephone = '';
        $user->role = $request->get('role') ? (int) $request->get('role') :  User::USER;
        $user->save();
        return redirect()->route('login');
    }
}
