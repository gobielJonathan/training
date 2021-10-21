<?php

namespace App\Http\Controllers;

use App\Models\Stimulus;
use App\Models\StimulusMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StimulusController extends Controller
{
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $s = new Stimulus;
        $s->name  = $request->get('name');
        $s->start  = $request->get('start');
        $s->end  = $request->get('end');
        $s->save();
        return redirect()->back();
    }

    public function get(){
        $stimulus = Stimulus::with("Detail.User")->get();
        return $stimulus;
    }

    public function remove(Request $request){
        $status = Stimulus::find($request->get('id'))->delete();
        $status &= StimulusMap::where("stimulus_id", $request->get('id'))->delete();
        return $status;
    }


}
