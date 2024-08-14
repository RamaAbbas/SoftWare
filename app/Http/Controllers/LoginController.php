<?php

namespace App\Http\Controllers;

use App\Models\Service;
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
            $user = User::where('email', $request->email)->first();
            //$user = Auth::user();
            //  return $user;
            if (Auth::attempt($valid)) {

                /*  $user = User::where('email', $request->email)->first();
                //$user = Auth::user();
                $user = Auth::guard('api')->user();
                $token = $user->createToken('authToken')->accessToken;
                //   session(['api_token' => $token]);*/
                return response()->json([
                    'sucsess' => 1,
                    'result' => "",
                    'message' => "User Login Sucsessfully",
                ], 200);
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

    public function register(Request $request)
    {
        /* $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);*/

        $data = $request->all();
        $data['password'] = bcrypt($request->password);

        $user = User::create($data);

        $token = $user->createToken('API Token')->accessToken;

        return response(['user' => $user, 'token' => $token]);
    }
    public function s()
    {
        $services = Service::all();
        return view('admin.service', compact('services'));
    }
}
