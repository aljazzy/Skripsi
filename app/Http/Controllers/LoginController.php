<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Http\Response;

class LoginController extends Controller
    {
        public function index(Request $request)
        {
            $hasher = app()->make('hash');
            $email = $request->input('email');
            $password = $request->input('password');
            $login = User::where('email', $email)->first();
            if (!$login) {
                $res['error'] = true;
                $res['message'] = 'Kamu Harus Login!';
                return response($res);
            }else{
                if ($hasher->check($password, $login->password)) {
                    $api_token = sha1(time());
                    $create_token = User::where('id', $login->id)
                        ->update(['api_token' => $api_token]);
                    if ($create_token) {
                        $res['error'] = false;
                        $res['api_token'] = $api_token;
                        $res['user'] = $login;
                        return response($res);
                    }
                }else{
                    $res['error'] = true;
                    $res['message'] = 'Email or password incorrect!';
                    return response($res);
                }
            }

        }
//        public function login(Request $request, Response $response){
//            $hasher = app()->make('hash');
//            $email = $request->input('email');
//            $password = $request->input('password');
//
//
//            $login = User::where('email', $email)->first();
//            if (!$login) {
//                $res['error'] = false;
//                $res['message'] = 'Anda Harus Login';
//                return response($res);
//            }else{
//                if ($hasher->check($password, $login->password)) {
//                    $api_token = sha1(time());
//                    $create_token = User::where('id', $login->id)->update(['api_token' => $api_token]);
//                    if ($create_token) {
//                        $res['error'] = true;
//                        $res['api_token'] = $api_token;
//                        $res['user'] = $login;
//                        return response($res);
//                    }
//                }else{
//                    $res['error'] = false;
//                    $res['message'] = 'Email or password incorrect!';
//                    return response($res);
//                }
//            }
//        }

    }