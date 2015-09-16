<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Theme;

class BackendBaseController extends Controller
{
    protected $theme;

    public static $requiredPermissions = [];

    public function __construct()
    {
        if (get_class($this) == 'App\Http\Controllers\Auth\AuthController')
        {
            $this->theme = Theme::uses('backend')->layout('auth');
        }
        else
        {
            $this->theme = Theme::uses('backend')->layout('backend');
            $this->theme->breadcrumb()->add('Dashboard', route('backend.dashboard.get'));
        }
    }
}
