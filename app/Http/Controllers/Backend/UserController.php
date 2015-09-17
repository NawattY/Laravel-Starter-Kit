<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\BackendBaseController;
use Auth;
use Illuminate\Http\Request;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Repositories\Eloquent\RoleRepositoryEloquent;

class UserController extends BackendBaseController
{
    public static $requiredPermissions = [
        'index'   => ['user-view'],
        'create'   => ['user-create'],
        'store'   => ['user-create'],
        'show'   => ['user-view'],
        'edit'   => ['user-update'],
        'update'   => ['user-update'],
        'destroy'   => ['user-suspend'],
    ];

    protected $userRepo, $roleRepo;

    public function __construct(UserRepositoryEloquent $userRepo, RoleRepositoryEloquent $roleRepo)
    {
        parent::__construct();

        $this->userRepo = $userRepo;
        $this->roleRepo = $roleRepo;

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
        $data['roles'] = $this->roleRepo->all(['id', 'role_title']);

        $this->theme->breadcrumb()->add('Create', route('backend.user.create.get'));
        return $this->theme->scope('user.create', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['first_name', 'last_name', 'email', 'password', 'password_confirmation', 'role']);

        try {
            $this->userRepo->create($input);

            return redirect()->route('backend.user.index.get')->withMessages(['success' => ['User has bees succfully created.']]);
        } catch (RepositoryException $e) {
            return redirect()->back()->withErrors($e->getErrors())->withInput();
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        try {
            $user = $this->userRepo->find($id);

            if (! $user) {
                echo '! $user';
            }

            dd($user);
        } catch (RepositoryException $e) {
            dd($e->getErrors());
        } catch (ModelNotFoundException $e) {
            dd($e->getMessage());
        } catch (Exception $e) {
            dd($e->getMessage());
        }
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
