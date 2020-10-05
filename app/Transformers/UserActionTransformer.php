<?php

namespace App\Transformers;

use App\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserActionTransformer extends TransformerAbstract
{

    /**
     * Transform the User entity.
     *
     * @param \App\Models\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {

        return [
            'id'        => (int) $model->id,
            'fullname'  => (string) $model->fullname,
            'username'  => (string) $model->username,
            'role'      => (string) $model->role,
            'email'     => (string) $model->email,
            'phone'     => (string) $model->phone,
            'organization'  => (int) $model->organization
        ];
    }
}
