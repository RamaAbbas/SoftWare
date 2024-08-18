<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;


class LoginController extends Controller
{


    public function login(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);


        if ($validation->fails()) {
            return response()->json([
                'success' => 0,
                'result' => null,
                'message' => $validation->errors(),
            ], 200);
        }

        try {

            $user = User::where('email', $request->email)->first();

            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {

                $user = Auth::user();
                $token = $user->createToken('Personal Access Token')->accessToken;
                error_log($token);

                session(['api_token' => $token]);


                return redirect()->route('showall.service');
            } else {

                return redirect()->back();
            }
        } catch (Exception $e) {

            return response()->json([
                'success' => 0,
                'result' => null,
                'message' =>$e->getMessage(),
            ], 200);
        }
    }

    public function view (){
        return view('admin.login');
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


    public function home()
    {
        // session(["local"=>"en"]);
        // return Auth::guard('api')->user();
        return view('layouts.app');
    }
}
