<?php

namespace App\Http\Controllers;

use App\Events\SendMail;
use App\Models\Webuser;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function signup()
    {
        return view('users.signup');
    }

    public function login()
    {
        return view('users.login');
    }

    public function register(Request $request)
    {
        // dd($request);

        try {
            $credentials = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required|string',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors());
        }


        Webuser::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
        ]);

        Event(new SendMail());

        Log::info('User Registered Successfully');

        return redirect()->route('login.get')->with('success', 'User Registered Successfully!');
    }

    public function loginUser(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            return redirect('/product')->with('success', 'Logged in successfully!');
        } else {
            return redirect('/login')->with("error", "Failed to Login, Please Check the Credentials");
        }

        Log::warning('Invalid Crdentials');

        return redirect()->route('login.get')->with("error", "Failed to Login, Please Check the Credentials");
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login.get')->with('success', 'Logged out successfully!');
    }

    public function remove($id)
    {
        Webuser::destroy($id);

        return redirect()->route('signup.get')->with('success', 'Account Deleted!');
    }
}
