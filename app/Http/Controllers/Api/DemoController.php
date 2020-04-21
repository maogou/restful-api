<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemoController extends Controller
{

    public function login(Request $request){

        $params = $request->only(['email','password']);

        Auth::attempt($params);


        $token = Auth::user()->createToken('my-app-token')->plainTextToken;

        return response()->json(['token'=>$token]);
    }

    public function me(){
        return response()->json(['user'=>Auth::user()]);
    }
}
