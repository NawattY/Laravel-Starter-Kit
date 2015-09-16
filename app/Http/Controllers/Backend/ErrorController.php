<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendBaseController;

class ErrorController extends BackendBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($code, $msg)
    {
        return $this->theme->scope('error.' . $code)->render();
    }
}
