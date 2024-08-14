<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;

class LoginController extends Controller
{
    /*  public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('token')->accessToken;
            session(['api_token' => $token]);
        }
    }*/

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "email" => 'required|email',
            "password" => "string|required|min:6"
        ]);
        if ($validation->fails()) {
            return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $validation->errors(),
            ], 200);
        }
        try {
            $valid = $request->only('email', 'password');
            if (Auth::attempt($valid)) {
                $user = Auth::user();
              //  $user = User::where('email', $request->email)->first();
                $token = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
             //   $token = $user->createToken('Personal Access Token')->accessToken;
                session(['api_token' => $token]);
                return redirect('/api/home');/*response()->json([
                    'sucsess' => 1,
                    'result' => $user,
                    'message' => "User Login Sucsessfully",
                ], 200);*/
            } else {
                return response()->json([
                    'sucsess' => 0,
                    'result' => "",
                    'message' => "Faild To Login",
                ], 200);
            }
        } catch (Exception $e) {
            return response()->json([
                'sucsess' => 0,
                'result' => null,
                'message' => $e,
            ], 200);
        }
    }
}
