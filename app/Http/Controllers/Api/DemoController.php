<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemoController extends ApiController
{

    public function login(Request $request){

        $params = $request->only(['email','password']);

        if (! Auth::attempt($params)) {
            return $this->setDataCode(401)->respondWithSuccess('用户名或密码错误');
        }


        $token = Auth::user()->createToken('my-app-token')->plainTextToken;


        return $this->respondWithSuccess([
            'token'=>$token,
            'user'=>Auth::user()
            ]
        );
    }

    public function me(){

        $this->apiAbort('那是一个秋天',30000);
        return response()->json(['user'=>Auth::user()]);
    }
}
