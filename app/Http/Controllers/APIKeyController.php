<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIKeyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data=array();
        $data['active_nav']="#apikey";
        $data['page_title']="API KEY";
        return view('api_key',$data);
    }
}
