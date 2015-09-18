<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\RoleRepository;
use App\Models\Role;
use App\Repositories\Exceptions\RepositoryException;
use Illuminate\Support\MessageBag;
use Validator;

/**
 * Class RoleRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
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
            'name' => 'required|max:255|unique:roles,name', // regex:/^[a-z]{1}[a-z0-9\_]*$/
            'display_name' => 'required|max:255',
        ]);

        if ($validator->fails())
        {
            throw new RepositoryException($validator->messages());
        }

        $role = parent::create(array_only($input, ['display_name', 'name', 'description']));

        if (! empty($input['permission'])) {
            $role->perms()->attach($input['permission']);
        }

        return $role;
    }

    public function update(array $input, $id)
    {
        if ($id == 1) {
            $messageBag = new MessageBag(array('Can\'t update, Because this is root role.'));
            throw new RepositoryException($messageBag);
        }

        $validator = Validator::make($input, [
            'name' => 'required|max:255|unique:roles,name,' . $id . '', // |regex:/^[a-z]{1}[a-z0-9\_]*$/
            'display_name' => 'required|max:255',
        ]);

        if ($validator->fails())
        {
            throw new RepositoryException($validator->messages());
        }

        $role = parent::update(array_only($input, ['display_name', 'name', 'description']), $id);

        $role->perms()->detach();

        if (! empty($input['permission'])) {
            $role->perms()->attach($input['permission']);
        }

        return $role;
    }

    public function delete($id)
    {
        if ($id == 1) {
            $messageBag = new MessageBag(array('Can\'t delete, Because this is root role.'));
            throw new RepositoryException($messageBag);
        }

        $role = $this->find($id);

        if (! $role->users->isEmpty()) {
            $messageBag = new MessageBag(array('Can\'t delete, Because this role have any users.'));
            throw new RepositoryException($messageBag);
        }

        $role->perms()->detach();

        $delete = parent::delete($id);

        return $delete;
    }
}
