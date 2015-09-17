<?php

namespace App\Repositories\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\User;

/**
 * Class UserTransformer
 * @package namespace App\Repositories\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param \User $model
     *
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */
//            'email' => $model->email,
//            'password' => $model->password,
//            'first_name' => $model->first_name,
//            'last_name' => $model->last_name,

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
