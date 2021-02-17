<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function handleRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|string|min:5'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Login direct
        Auth::Login($user);

        //sending email
        Mail::to($user->email)->send(new RegisterMail($user->name));

        return redirect( route('allBooks') ); //l7ad m3ml l saf7a l ra2esia
    }

    public function login()
    {
        return view('auth.login');
    }

    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|min:5'
        ]);

        // $is_login = Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        // dd($is_login);

        if ( ! Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            // return redirect( route('auth.login') );
            return back();
        }

        return redirect( route('allBooks') );

    }

    public function logout()
    {
        Auth::logout();
        return redirect( route('auth.login'));
    }


    public function redirectToProviderGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    public function handleProviderCallbackGithub()
    {
        $user = Socialite::driver('github')->user();

        // $user->token;
        // dd($user);
        $email = $user->email;
        $db_user = User::where('email', $email)->first();
        if ($db_user == null)
        {
            $registered_user = User::create([
                'name' => $user->name, //nickname
                'email' => $user->email,
                'password' => Hash::make('123456789'),
                'oauth_token' => $user->token
            ]);
            Auth::login($registered_user); //khazen el data fel session
        }
        else
        {
            Auth::login($db_user);
        }

        return redirect(route('allBooks'));
    }



    public function redirectToProviderFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallbackFacebook()
    {
        $user = Socialite::driver('facebook')->user();

        // $user->token;
        // dd($user);
        $email = $user->email;
        $db_user = User::where('email', $email)->first();
        if ($db_user == null)
        {
            $registered_user = User::create([
                'name' => $user->name, //nickname
                'email' => $user->email,
                'password' => Hash::make('123456789'),
                'oauth_token' => $user->token
            ]);
            Auth::login($registered_user); //khazen el data fel session
        }
        else
        {
            Auth::login($db_user);
        }

        return redirect(route('allBooks'));
    }

    public function redirectToProviderGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleProviderCallbackGoogle()
    {
        $user = Socialite::driver('google')->user();

        // $user->token;
        // dd($user);
        $email = $user->email;
        $db_user = User::where('email', $email)->first();
        if ($db_user == null)
        {
            $registered_user = User::create([
                'name' => $user->name, //nickname
                'email' => $user->email,
                'password' => Hash::make('123456789'),
                'oauth_token' => $user->token
            ]);
            Auth::login($registered_user); //khazen el data fel session
        }
        else
        {
            Auth::login($db_user);
        }

        return redirect(route('allBooks'));
    }
}
