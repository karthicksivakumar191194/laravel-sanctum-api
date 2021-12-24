<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request){
        $authenticateVia = $request->header('Authentication', 'token');

        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $response = [];

        if($authenticateVia === "cookie"){
            $credentials = $request->only('email', 'password');
            if(Auth::attempt($credentials)){
                $loggedInUser = Auth::user();      
                $response = ['id' => $loggedInUser->id, 'name' => $loggedInUser->name, 'email' => $loggedInUser->email ];
            }
        }else{
            $token = $user->createToken('myapptoken')->plainTextToken;
            $response = ['token' => $token];
        }

        return response($response, 201);
    }
	
	public function logout(Request $request){
        Auth::user()->tokens()->delete();

        $response = [
            'message' => 'Logged out',
        ];

        return response($response);

    }
}
