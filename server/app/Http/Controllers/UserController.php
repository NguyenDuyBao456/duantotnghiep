<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{

    use HasApiTokens,Notifiable;


    // public function register(Request $request)
    // {
    //     $user = User::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);
    //     return response()->json($user);
    // }


    public function login(Request $request)
    {
        $user = User::where("email", $request->email)->first();

        if(!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(["message" => "Tài khoản hoặc mật khẩu không chính xác"], 401);
        }

        $expiration = now()->addMinutes(15);



        $token = $user->createToken('auth_token');
        $user->tokens()->latest()->first()->update(['expires_at' => $expiration]);



        return response()->json([
            'message' => 'Đăng nhập thành công',
            'token' => $token
        ], 200);
    }


    public function index(Request $request) {
        $user = User::all();
        return response()->json($user);
    }

    public function decoded(Request $request) {
        $token = $request->header('Authorization');


        if (!$token || !str_starts_with($token, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorizedssss - Token missing'],401);
        }

        $token = substr($token, 7);

        $accessToken = PersonalAccessToken::findToken($token);
        if (!$accessToken) {
            return response()->json(['message' => 'Unauthorizedssss - Invalid token'],401);
        }
        $user = $accessToken->tokenable;
        return response($user, 200);
    }

    public function register(Request $request) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = substr(str_shuffle($characters), 0, 6);
        $hash = Hash::make($password);

        $user = User::where("email", $request->email)->first();

        if($user) {
            return response()->json(['message' => 'Email đã tồn tại'], 409);
        }

        $createUser = User::create([
            'name' => explode("@",$request->email)[0],
            'email' => $request->email,
            'password' => $hash
        ]);

        $createUser->password = $password;

        Mail::to($request->email)->send(new RegisterMail($createUser));
        return response()->json(['message' => 'Chúng tôi đã gửi thông tin tài khoản qua email của bạn, vui lòng kiểm tra email']);
    }
}
