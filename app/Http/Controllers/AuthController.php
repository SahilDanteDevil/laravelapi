<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            $user = Auth::user();
            $remember_token = User::find($user->id);

            $token = $user->createToken('admin')->accessToken;            
            return response(['user' => Auth::user(),'access_token'=>$token], Response::HTTP_ACCEPTED);
        }

        return response(['error' => 'Invalid Credentials'], Response::HTTP_UNAUTHORIZED);
    }

    public function register(RegisterRequest $request){
        $user = User::create($request->only('first_name','last_name','email','role_id') + ['password' => Hash::make($request->input('password'))]);
        return response($user, Response::HTTP_CREATED);
    }
}
