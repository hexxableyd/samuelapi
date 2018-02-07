<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestRemaining;
use App\API_Key;

class ValidateKey extends Controller
{
    public function index(Request $request){
        $valid=false;
        $api_key=API_Key::where('key',$request->input('key'))->first();
        if($api_key!=null){
            $request_remaining = RequestRemaining::where('user_id',$api_key->user_id)->first();
            if($request_remaining->requests > 0){
                RequestRemaining::find($request_remaining->id)->decrement('requests');
                $valid=true;
            }
        }
        return response()->json($valid);
    }
}
