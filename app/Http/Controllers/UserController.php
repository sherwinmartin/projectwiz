<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;
use Auth;
use Redirect;

class UserController extends Controller
{
    /**
     * Display login form.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        $data = [
            'page_title'        => 'Log In',
            'navi_group'        => 'login'
        ];
        
        return view('users.login', $data);
    }


    /**
     * Authenticate user.
     * @param Requests\AuthenticateRequest $request
     * @return $this
     */
    public function authenticate(Requests\AuthenticateRequest $request)
    {
        $credentials = [
            'username'      => $request['username'],
            'password'      => $request['password']
        ];

        if (Auth::attempt($credentials))
        {
            return redirect::intended('/')->with('success', 'Login successful.');
        }

        return back()->withInput()->withErrors('Login failed, invalid credentials provided.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect::to('/login')->with('success', 'Logout successful.');
    }
}
