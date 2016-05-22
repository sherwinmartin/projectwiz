<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function getEmail()
    {
        $data = [
            'page_title'    => 'Reset My Password',
            'navi_group'    => 'password'
        ];

        return view('auth.password', $data);
    }

    public function postEmail(Request $request)
    {
        //$this->validate($request, ['email' => 'required|email']);


        $response = Password::sendResetLink($request->only('email'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('success', trans($response));

            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    public function getReset($token)
    {
        $data = [
            'page_title'    => 'Reset My Password',
            'navi_group'    => 'password',
            'token'         => $token
        ];

        $check_token = DB::table('password_resets')->where('token', $token)->first();

        if (!$check_token)
        {
            return redirect()->to('/password/email')->with('error', 'Token is invalid. You must request a new one to continue.');
        }

        return view('auth.reset', $data);
    }
}
