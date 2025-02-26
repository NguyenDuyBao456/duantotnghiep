<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{



    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response()->json($user);
    }


    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["message" => "Tài khoản hoặc mật khẩu không chính xác"], 401);
        }

        return response()->json([
            'message' => 'Đăng nhập thành công',
            'user' => $user
        ], 200);
    }
}
