<?php

namespace App\Http\Controllers;

use App\Models\Seva;
use Illuminate\Http\Request;

class SevaController extends Controller
{


    public function sevas(Request $request){

        $seva = Seva::with('seva_images')
                    ->where('status', true)
                    ->where('slug', $request->slugs)->first();
        if(!$seva){
            abort(404);
        }

        $lstSevas = Seva::where('status', true)->orderBy('serial_no', 'asc')->get();
        return view('frontend.website.sevas', compact('seva', 'lstSevas'));

    }



}
