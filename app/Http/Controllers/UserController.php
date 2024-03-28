<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
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

        return response()->json('Creation avec success');
    }

    public function UpdateUser(Request $request)
    {
        $user = User::findOrfail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = $request->role;

        $user->update();
        return response()->json('Mettre à jour avec success ');
    }

    public function DeleteUser(Request $request)
    {
        $deleteUser = User::findOrfail($request->id)->delete();
        return response()->json('suppression avec success');
    }

    public function GetUser()
    {
        $user = User::all();
        return response()->json($user);
    }
}
