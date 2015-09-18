<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BackendBaseController;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordController extends BackendBaseController
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

    public function __construct()
    {
        parent::__construct();

        $this->middleware('guest');
    }

    public function getEmail()
    {
        $data = array();
        $data['error'] = \Session::get('error');
        return $this->theme->scope('auth.password-forgot', $data)->render();
    }

    public function getReset($token = null)
    {
        if (is_null($token)) {
            throw new NotFoundHttpException;
        }

        $data = array();
        $data['error'] = \Session::get('error');
        $data['token'] = $token;
        return $this->theme->scope('auth.password-reset', $data)->render();
    }

    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $this->resetPassword($user, $password);
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                \Auth::logout();
                return redirect()->route('auth.login.get')->withMessages(['success' => ['Your account has bees successfully reset.']]);
            default:
                return redirect()->back()
                    ->withInput($request->only('email'))
                    ->withErrors(['email' => trans($response)]);
        }
    }
}
