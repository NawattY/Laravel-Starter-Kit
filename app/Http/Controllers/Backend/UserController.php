<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendBaseController;
use Auth;

class UserController extends BackendBaseController
{
    public static $requiredPermissions = [
        'index'   => ['view-user'],
        'create'   => ['create-user'],
        'store'   => ['create-user'],
        'show'   => ['view-user'],
        'edit'   => ['update-user'],
        'update'   => ['update-user'],
        'destroy'   => ['suspend-user'],
    ];

    public function __construct()
    {
        parent::__construct();

        $this->theme->breadcrumb()->add('User', route('backend.user.index.get'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->theme->scope('user.index')->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->theme->breadcrumb()->add('Create', route('backend.user.create.get'));
        return $this->theme->scope('user.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
