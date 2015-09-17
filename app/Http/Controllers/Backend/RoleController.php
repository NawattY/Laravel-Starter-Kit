<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendBaseController;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Eloquent\RoleRepositoryEloquent;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;

class RoleController extends BackendBaseController
{
    public static $requiredPermissions = [
        'index'   => ['role-view'],
        'create'   => ['role-create'],
        'store'   => ['role-create'],
        'show'   => ['role-view'],
        'edit'   => ['role-update'],
        'update'   => ['role-update'],
        'destroy'   => ['role-suspend'],
    ];

    protected $roleRepo, $permissionRepo;

    public function __construct(RoleRepositoryEloquent $roleRepo, PermissionRepositoryEloquent $permissionRepo)
    {
        parent::__construct();

        $this->roleRepo = $roleRepo;
        $this->permissionRepo = $permissionRepo;

        $this->theme->breadcrumb()->add('Role', route('backend.role.index.get'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['roles'] = $this->roleRepo->paginate();

        return $this->theme->scope('role.index', $data)->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data['permissions'] = $this->permissionRepo->all(['id', 'permission_title']);

        $this->theme->breadcrumb()->add('Create', route('backend.role.create.get'));
        return $this->theme->scope('role.create', $data)->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['role_title', 'role_slug', 'permission']);

        try {
            $this->roleRepo->create($input);

            return redirect()->route('backend.role.index.get')->withMessages(['success' => ['Role has bees successfully created.']]);
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
        return redirect()->route('backend.role.edit.get', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        if ($id == 1) {
            return redirect()->route('backend.role.index.get')->withMessages(['danger' => ['Can\'t update root role.']]);
        }

        try {
            $data['role'] = $this->roleRepo->find($id);

            $data['permissions'] = $this->permissionRepo->all(['id', 'permission_title']);

            $this->theme->breadcrumb()->add('Edit', route('backend.role.edit.get', $id));
            return $this->theme->scope('role.edit', $data)->render();

        } catch (RepositoryException $e) {
            return redirect()->route('backend.role.index.get')->withMessages(['danger' => $e->getErrors()->toArray()]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('backend.role.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        } catch (Exception $e) {
            return redirect()->route('backend.role.index.get')->withMessages(['danger' => [$e->getMessage()]]);
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
        if ($id == 1) {
            return redirect()->route('backend.role.index.get')->withMessages(['danger' => ['Can\'t update root role.']]);
        }

        $input = $request->only(['role_title', 'role_slug', 'permission']);

        try {
            $this->roleRepo->update($input, $id);

            return redirect()->route('backend.role.index.get')->withMessages(['success' => ['Role has bees successfully updated.']]);
        } catch (RepositoryException $e) {
            return redirect()->back()->withErrors($e->getErrors())->withInput();
        } catch (ModelNotFoundException $e) {
            return redirect()->route('backend.role.index.get')->withMessages(['danger' => [$e->getMessage()]]);
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
            return redirect()->route('backend.role.index.get')->withMessages(['danger' => ['Can\'t delete root role.']]);
        }

        try {
            $role = $this->roleRepo->delete($id);

            return redirect()->route('backend.role.index.get')->withMessages(['success' => ['Role has bees successfully deleted.']]);
        }  catch (RepositoryException $e) {
            return redirect()->route('backend.role.index.get')->withMessages(['danger' => [$e->getErrors()]]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('backend.role.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        } catch (Exception $e) {
            return redirect()->route('backend.role.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        }
    }
}
