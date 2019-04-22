<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Validator;


class UserController extends Controller
{
    public function register(Request $request){

        $rules =[
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response($validator->errors(),400);
        }

        $data = new \App\User();
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->password = $request->input('password');

        if($data->save()){
            $res['message'] = 'Data has been Registered!';
            $res['value'] = $data;

            return response($res);
        }

    }

    public function login(Request $request){

        $credentials = ['email'=>$request->email, 'password'=>$request->password];
        if(Auth::attempt($credentials)){
            $res['message']='Failed to Login!';
            return response($res);
        }

        $res['message'] = 'Success!';

        return response($res);
    }
}
