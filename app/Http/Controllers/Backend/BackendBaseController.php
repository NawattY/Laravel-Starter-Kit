<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Theme;

class BackendBaseController extends Controller
{
    protected $theme;

    public function __construct()
    {
        if (get_class($this) == 'App\Http\Controllers\Backend\AuthController')
        {
            $this->theme = Theme::uses('backend')->layout('auth');
        }
        else
        {
            $this->theme = Theme::uses('backend')->layout('backend');
            $this->theme->breadcrumb()->add('Dashboard', route('admin.dashboard.index'));
        }
    }
}
