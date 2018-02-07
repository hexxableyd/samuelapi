<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\API_Key;
use Auth;
use Validator;

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

    public function gen_api_key(){
        $key = APIKeyController::gen_key();
        while (API_Key::where('key', '=', $key)->exists()) {
            $key=APIKeyController::gen_key();
        }
        return response()->json(['key' => $key]);
    }

    private function gen_key(){
        $characters="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $key = '';
        $keyLength=40;
        for ($i = 0; $i < $keyLength; $i++) {
            $key .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $key;
    }

    public function create_api_key(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20'
        ]);
        if ($validator->passes()) {
            API_Key::create([
                'user_id' => Auth::user()->id ,
                'key' => $request->input('key'),
                'name' => $request->input('name')
            ]);
			return response()->json(['success'=> true]);
        }
    	return response()->json([
            'success'=> false,
            'errors'=>$validator->errors()->all()
            ]);
    }

    public function show_api_keys(){
        $keys = API_Key::where('user_id', '=', Auth::user()->id)->get();
        $data = "";
        foreach ($keys as $key) {
            $data .="
                <tr>
                    <td>".$key['name']."</td>
                    <td>".date('M d, Y', strtotime($key['created_at']))."</td>
                    <td>".$key['key']."</td>
                    <td>".$key['requests']."</td>
                    <td>
                        <button title='Edit' onclick='editKey(".$key['id'].")' class='btn btn-primary btn-sm '><i class='fas fa-edit'></i></button>
                        <button title='Delete' onclick='deleteKey(".$key['id'].")' class='btn btn-danger btn-sm'><i class='fas fa-trash-alt'></i></button>
                    </td>
                </tr>
            ";
        }
        return $data;
    }

    public function get_api_key(Request $request){
        $key = API_Key::where('id', $request->input('id'))->first();
        return response()->json($key);
    }

    public function update_api_key(Request $request){
        return API_Key::where('id', $request->input('id'))->update(['name' => $request->input('name')]);
    }

    public function delete_api_key(Request $request){
        return API_Key::where('id', $request->input('delete_key_id'))->delete();
    }
}