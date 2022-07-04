<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);
        if (!Auth::attempt($attr)) {
            return response()->json(['status' => "fail", 'msg' => 'Credentials not match', 'data' => []], 401);
        }
        $token = auth()->user()->createToken('API Token')->plainTextToken;
        return response()->json(['status' => "success", 'msg' => 'Login Successfully', 'data' => ['token' => $token, 'user' => Auth::user()]], 200);
    }
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['status' => "success", 'msg' => 'Logedout Successfully', 'data' => []], 200);
    }
}
