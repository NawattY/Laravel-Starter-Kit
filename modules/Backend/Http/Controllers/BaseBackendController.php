<?php

namespace Modules\Backend\Http\Controllers;

use Nwidart\Modules\Routing\Controller;
use Theme;

class BaseBackendController extends Controller
{
	public function __construct()
	{
        Theme::setActive('backend');
	}
}
