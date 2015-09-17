<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BackendBaseController;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Repositories\Eloquent\PermissionRepositoryEloquent;

class PermissionController extends BackendBaseController
{
    public static $requiredPermissions = [
//        'index'   => ['role-view'],
//        'create'   => ['role-create'],
//        'store'   => ['role-create'],
//        'show'   => ['role-view'],
//        'edit'   => ['role-update'],
//        'update'   => ['role-update'],
//        'destroy'   => ['role-suspend'],
    ];

    protected $permissionRepo;

    public function __construct(PermissionRepositoryEloquent $permissionRepo)
    {
        parent::__construct();

        $this->permissionRepo = $permissionRepo;

        $this->theme->breadcrumb()->add('Permission', route('backend.permission.index.get'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $data['permissions'] = $this->permissionRepo->paginate(25);

        return $this->theme->scope('permission.index', $data)->render();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $this->theme->breadcrumb()->add('Create', route('backend.permission.create.get'));
        return $this->theme->scope('permission.create')->render();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['permission_title', 'permission_slug', 'permission_description']);

        try {
            $this->permissionRepo->create($input);

            return redirect()->route('backend.permission.index.get')->withMessages(['success' => ['Permission has bees successfully created.']]);
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
        return redirect()->route('backend.permission.edit.get', $id);
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
            $data['permission'] = $this->permissionRepo->find($id);

            $this->theme->breadcrumb()->add('Edit', route('backend.permission.edit.get', $id));
            return $this->theme->scope('permission.edit', $data)->render();

        } catch (RepositoryException $e) {
            return redirect()->route('backend.permission.index.get')->withMessages(['danger' => $e->getErrors()->toArray()]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('backend.permission.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        } catch (Exception $e) {
            return redirect()->route('backend.permission.index.get')->withMessages(['danger' => [$e->getMessage()]]);
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
        $input = $request->only(['permission_title', 'permission_slug', 'permission_description']);

        try {
            $this->permissionRepo->update($input, $id);

            return redirect()->route('backend.permission.index.get')->withMessages(['success' => ['Permission has bees successfully updated.']]);
        } catch (RepositoryException $e) {
            return redirect()->back()->withErrors($e->getErrors())->withInput();
        } catch (ModelNotFoundException $e) {
            return redirect()->route('backend.permission.index.get')->withMessages(['danger' => [$e->getMessage()]]);
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
        try {
            $permission = $this->permissionRepo->delete($id);

            return redirect()->route('backend.permission.index.get')->withMessages(['success' => ['Permission has bees successfully deleted.']]);
        }  catch (RepositoryException $e) {
            return redirect()->route('backend.permission.index.get')->withMessages(['danger' => [$e->getErrors()]]);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('backend.permission.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        } catch (Exception $e) {
            return redirect()->route('backend.permission.index.get')->withMessages(['danger' => [$e->getMessage()]]);
        }
    }
}
