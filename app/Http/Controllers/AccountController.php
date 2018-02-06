<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data=array();
        $data['active_nav']=".account";
        $data['page_title']="Account Settings";
        return view('account',$data);
    }
}
