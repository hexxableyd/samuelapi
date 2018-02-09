<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequestRemaining;
use App\API_Key;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=array();
        $data['active_nav']="#dashboard";
        $data['page_title']="DASHBOARD";
        return view('home',$data);
    }

    public function fetch_data(){
        $request_remaining = RequestRemaining::where('user_id',Auth::user()->id)->first();
        $Keys = API_Key::where('user_id', '=', Auth::user()->id)->get();
        $keys = array(array("Key","No of Requests"));
        $total_requests = 0;
        foreach ($Keys as $key) {
            $total_requests += $key['requests'];
            array_push($keys,array(
                $key['name'],
                $key['requests']
            ));
        }
        
        return response()->json([
            'request_remaining'=> $request_remaining->requests,
            'maximum_request' => 100000,
            'keys' => $keys,
            'total_requests' => $total_requests
            ]);
    }
}
