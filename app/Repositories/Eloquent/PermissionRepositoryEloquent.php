<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\PermissionRepository;
use App\Models\Permission;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Support\MessageBag;
use Validator;

/**
 * Class PermissionRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $input)
    {
        $input = array_filter($input);

        $validator = Validator::make($input, [
            'display_name' => 'required|max:255',
            'name' => 'required|max:255|unique:permissions,name|regex:/^[a-z]{1}[a-z0-9\-]*$/',
        ]);

        if ($validator->fails())
        {
            throw new RepositoryException($validator->messages());
        }

        return parent::create(array_only($input, ['display_name', 'name', 'description']));
    }

    public function update(array $input, $id)
    {
        $validator = Validator::make($input, [
            'display_name' => 'required|max:255',
            'name' => 'required|max:255|unique:permissions,name,' . $id . '|regex:/^[a-z]{1}[a-z0-9\-]*$/',
        ]);

        if ($validator->fails())
        {
            throw new RepositoryException($validator->messages());
        }

        return parent::update(array_only($input, ['display_name', 'name', 'description']), $id);
    }

    public function delete($id)
    {
        $permission = $this->find($id);

        if (! $permission->roles->isEmpty()) {
            $messageBag = new MessageBag(array('Can\'t delete, Because any role have this permission.'));
            throw new RepositoryException($messageBag);
        }

        $delete = parent::delete($id);

        return $delete;
    }
}
