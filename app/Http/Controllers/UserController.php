<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function CreateUser(Request $request)
    {
        $UserValidate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);


        $user = new User();
        $user->name = $UserValidate['name'];
        $user->email = $UserValidate['email'];
        $user->password = Hash::make($UserValidate['password']);
        $user->role = $UserValidate['role'];

        $user->save();

        return response()->json('Creation avec success' ,201);
    }



    public function UpdateUser(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        $user->update();
        return response()->json($user,202);
    }



    public function DeleteUser(Request $request)
    {
        $deleteUser = User::findOrfail($request->id)->delete();
        return response()->json('suppression avec success', 202);
    }



    public function GetUser()
    {
        $user = User::all();
        return response()->json($user);
    }
}
