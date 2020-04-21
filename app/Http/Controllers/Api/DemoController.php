<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemoController extends ApiController
{

    public function login(Request $request){

        $params = $request->only(['email','password']);

        Auth::attempt($params);


        $token = Auth::user()->createToken('my-app-token')->plainTextToken;

        return response()->json(['token'=>$token]);
    }

    public function me(){

        $this->apiAbort('那是一个秋天',30000);
        return response()->json(['user'=>Auth::user()]);
    }
}
