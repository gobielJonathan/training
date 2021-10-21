<?php

namespace App\Http\Controllers;

use App\Models\StimulusMap;
use Illuminate\Http\Request;

class StimulusMapController extends Controller
{
    public function map(Request $request)
    {
        StimulusMap::where([
            ['stimulus_id' ,'=', $request->get('stimulus')],
        ])->delete();

        if($request->get('users'))
        foreach ($request->get('users') as $key => $value) {
            $m = new StimulusMap;
            $m->stimulus_id = $request->get('stimulus');
            $m->user_id = $value;
            $m->save();
        }
        return redirect()->back();
    }
}
