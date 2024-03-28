<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\key;


class AuthController extends Controller
{
    public function register(Request $request)
    {
        $valider = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = new User();
        $user->name = $valider['name'];
        $user->email = $valider['email'];
        $user->password = Hash::make($valider['password']);
        $user->role = $valider['role'];

        $user->save();

        return response()->json('Register Avec Succes');
    }


    public function login(Request $request)
    {
        $retrieve = $request->only('name','email');

        if(Auth::attempt($retrieve))
        {
            $user = Auth::User();
            $token =$this->GenererToken($user);

            return response()->json(['token'=>$token]);
        }
        else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }



    public function GenererToken($user)
    {
        $payload =[
            'id'=> $user->id,
            'email'=> $user->email,
        ];

        return JWT::encode($payload, env('JWT_SECRET'));
    }
}
