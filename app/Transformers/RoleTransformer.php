<?php

namespace App\Transformers;

use App\Enums\DateFormatEnum;
use App\Helpers\Helpers;
use App\Models\Role;
use App\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class RoleTransformer extends TransformerAbstract
{

//    protected $availableIncludes  = [
//        'createdByUser',
//        'updatedByUser'
//    ];

    protected $defaultIncludes  = [
        'createdByUser',
        'updatedByUser'
    ];
    /**
     * Transform the User entity.
     *
     * @param \App\Models\User $model
     *
     * @return array
     */
    public function transform(Role $model)
    {

        return [
            'id'        => (int) $model->id,
            'name'  => (string) $model->name,
            'roles'  => (string) $model->display_name,
            'description'      => (string) $model->description,
            'status'  => (string) $model->record_status_id,
            'created_at'=> Helpers::isDateValid($model->created_at) ? $model->created_at->format(DateFormatEnum::dMYHi) : null,
            'updated_at'=> Helpers::isDateValid($model->updated_at) ? $model->updated_at->format(DateFormatEnum::dMYHi) : null,
        ];
    }

    public function includeCreatedByUser(Role $model)
    {
        $result = $model->createdByUser;
        if(!is_null($result)) {
            return $this->item($result, new UserTransformer);
        } return null;

    }

    public function includeUpdatedByUser(Role $model)
    {
        $result = $model->updatedByUser;
        if(!is_null($result)) {
            return $this->item($result, new UserTransformer);
        } return null;
    }
}
