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

            $this->theme->breadcrumb()->setTemplate('
                <ul class="breadcrumb">
                @foreach ($crumbs as $i => $crumb)
                    @if ($i != (count($crumbs) - 1))
                    <li><a href="{{ $crumb["url"] }}">{{ $crumb["label"] }}</a></li>
                    @else
                    <li class="active">{{ $crumb["label"] }}</li>
                    @endif
                @endforeach
                </ul>
            ');

            $this->theme->breadcrumb()->add('Dashboard', route('backend.dashboard.index.get'));
        }
    }
}
