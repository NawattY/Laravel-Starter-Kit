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
        $data['users'] = $this->userRepo->paginate();

        return $this->theme->scope('user.index', $data)->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data['roles'] = $this->roleRepo->findWhere([['id','!=','1']], ['id', 'role_title']);

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

            return redirect()->route('backend.user.index.get')->withMessages(['success' => ['User has bees successfully created.']]);
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
        return redirect()->route('backend.user.edit.get', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        try {
            $data['user'] = $this->userRepo->find($id);

            $data['roles'] = $this->roleRepo->findWhere([['id','!=','1']], ['id', 'role_title']);

            $this->theme->breadcrumb()->add('Edit', route('backend.user.edit.get', $id));
            return $this->theme->scope('user.edit', $data)->render();

        } catch (RepositoryException $e) {
            return redirect()->route('backend.user.index.get')->withMessages(['danger' => $e->getErrors()->toArray()]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('backend.user.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        } catch (Exception $e) {
            return redirect()->route('backend.user.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        }
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
        $input = $request->only(['first_name', 'last_name', 'email', 'password', 'password_confirmation', 'role']);

        try {
            $this->userRepo->update($input, $id);

            return redirect()->route('backend.user.index.get')->withMessages(['success' => ['User has bees successfully updated.']]);
        } catch (RepositoryException $e) {
            return redirect()->back()->withErrors($e->getErrors())->withInput();
        } catch (ModelNotFoundException $e) {
            return redirect()->route('backend.user.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($id == 1) {
            return redirect()->route('backend.user.index.get')->withMessages(['danger' => ['Can\'t delete root user.']]);
        }

        try {
            $user = $this->userRepo->delete($id);

            return redirect()->route('backend.user.index.get')->withMessages(['success' => ['User has bees successfully suspended.']]);
        }  catch (RepositoryException $e) {
            return redirect()->route('backend.user.index.get')->withMessages(['danger' => [$e->getErrors()]]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('backend.user.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        } catch (Exception $e) {
            return redirect()->route('backend.user.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        }
    }
}
