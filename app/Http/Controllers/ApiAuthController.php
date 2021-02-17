<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ApiAuthController extends Controller
{
    public function handleRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:5'
        ]);

        if ($validator->fails()) 
        {
           $errors = $validator->errors();
            return response()->json($errors);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'api_token' => Str::random(64)
        ]);

        return response()->json($user->api_token);
    }

    public function handleLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:5'
        ]);

        if ($validator->fails()) 
        {
           $errors = $validator->errors();
            return response()->json($errors);
        }

        $is_user = Auth::attempt(['email' => $request->email,'password' => $request->password]);
        
        if ($is_user == false) 
        {
            $error = "Credentials are not correct";
            return response()->json($error);
        }
        $user = User::where('email', '=', $request->email)->first();

        $new_api_token = Str::random(64);

        $user->update([
            'api_token' => $new_api_token
        ]);

        return response()->json($new_api_token);
    }

    public function logout(Request $request)
    {
        $api_token = $request->api_token;

        $user = User::where('api_token', '=', $api_token)->first();
        
        if ($user == null) 
        {
            $error = "token not correct";
            return response()->json($error);
        }

        //Lw el api_token mwgoda fel db ems7 el token dah
        $user->update([
            'api_token' => NULL
        ]);

        $success = "logged out successfully";
        return response()->json($success);
    }
}
