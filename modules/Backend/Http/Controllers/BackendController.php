<?php

namespace Modules\Backend\Http\Controllers;

use Theme;

class BackendController extends BaseBackendController
{
	public function index()
	{
        return view('index');
	}
}
