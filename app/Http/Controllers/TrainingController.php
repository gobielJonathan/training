<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Training;
use App\Models\StimulusMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    public function index()
    {
        $total_cart = Cart::count();
        $banner = Training::where('status', Training::ACTIVE)->latest()->first();
        return view('home', compact('total_cart', 'banner'));
    }

    public function add(Request $request)
    {
        $t = new Training;
        $t->title = $request->get('title');
        $t->price = $request->get('price');
        $t->description = $request->get("description");
        $t->status = Training::ACTIVE;

        $image_path = Storage::put('public/training', $request->file('image'));
        $image_path = Storage::url($image_path);
        $t->image = $image_path;

        $t->save();
        return redirect()->back();
    }

    public function toggleStatus(Request $request)
    {
        $t = Training::find($request->get('id'));
        if ($t->status == Training::ACTIVE)
            $t->status = Training::DEACTIVE;
        else $t->status = Training::ACTIVE;
        $t->save();
        return $t->status == Training::ACTIVE ? "Active" : "Not Active";
    }

    public function remove(Request $request){
        return Training::find($request->get('id'))->delete();
    }

}
