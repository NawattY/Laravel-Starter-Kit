<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BackendBaseController;
use Illuminate\Foundation\Auth\ResetsPasswords;

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

    public function redirectPath()
    {
        return route('auth.login.get');
    }
}
