<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request){

        return response()->json('Mau Ngapain...', 200);
    }


    public function register(Request $request)
    {
        $id_user = rand(100,300);
        $username = $request->input('username');
        $email = $request->input('email');
        $password = app('hash')->make($request['password']);
        $handphone = $request->input('handphone');
        $role = $request->input('role');
        $register = User::create([
            'id_user' => $id_user,
            'username'=> $username,
            'email'=> $email,
            'password'=> $password,
            'handphone' => $handphone,
            'role' => $role
        ]);
        if ($register) {
            $res['success'] = true;
            $res['message'] = 'Success register!';
            $res['redirect'] = 1;
            return response($res);
        }else{
            $res['success'] = false;
            $res['message'] = 'Failed to register!';
            return response($res);
        }
    }
    public function get_user(Request $request, $id)
    {
        $user = User::where('id', $id)->get();
        if ($user) {
            $res['success'] = true;
            $res['message'] = $user;

            return response($res);
        }else{
            $res['success'] = false;
            $res['message'] = 'Cannot find user!';

            return response($res);
        }
    }
    public function create(Request $request){


        $username = $request->input('username');
        $email = $request->input('email');
        $password = app('hash')->make($request['password']);


        dd($password);
        //return response()->json($Book);

    }
    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $input = $request->all();
        if ($input->hasFile('gambar')){
            $gambar = $request->file('gambar');
            //$basepath = 'http://great.lov/api-aero/public/uploads/';
            $destPath = public_path('/avatar');
            $filename = time().'.'.$gambar->getClientOriginalExtension();
            $gambar->move($destPath, $filename);
            $user->gambar = $filename;
        }
        $user->fill($input);
        $user->save();

        return response()->json(['status' => 'success']);
    }
}
