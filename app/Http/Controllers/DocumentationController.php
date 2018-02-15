<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Parameter;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=array();
        $data['active_nav']="#documentation";
        $data['page_title']="Documentation";

        $basic_src_file = fopen("../docs/basic.html", "r") or die("Unable to open file!");
        $basic_code = fread($basic_src_file,filesize("../docs/basic.html"));
        fclose($basic_src_file);

        $set_param_src_file = fopen("../docs/set_params.html", "r") or die("Unable to open file!");
        $set_param = fread($set_param_src_file,filesize("../docs/set_params.html"));
        fclose($set_param_src_file);

        $data['basic_code'] = $basic_code;
        $data['set_param'] = $set_param;

        $data['parameters'] = Parameter::orderBy('param', 'asc')->get();


        return view('documentation',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
