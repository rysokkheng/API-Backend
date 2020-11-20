<?php

namespace App\Transformers;

use App\Enums\DateFormatEnum;
use App\Helpers\Helpers;
use App\User;
use Illuminate\Support\Facades\App;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
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
    public function transform(User $model)
    {

        return [
            'id'        => (int) $model->id,
            'fullname'  => (string) $model->fullname,
            'username'  => (string) $model->username,
            'roles'      => (string) $model->roles,
            'email'     => (string) $model->email,
            'phone'     => (string) $model->phone,
            'organization'  => (int) $model->organization,
            'status'    => (int) $model->record_status_id,
            'created_at'=> Helpers::isDateValid($model->created_at) ? $model->created_at->format(DateFormatEnum::dMYHi) : null,
            'updated_at'=> Helpers::isDateValid($model->updated_at) ? $model->updated_at->format(DateFormatEnum::dMYHi) : null,
            'lang'      => App::getLocale()
        ];
    }

    public function includeCreatedByUser(User $model)
    {
        $result = $model->createdByUser;
        if(!is_null($result)) {
            return $this->item($result, new UserActionTransformer);
        } return null;

    }

    public function includeUpdatedByUser(User $model)
    {
        $result = $model->updatedByUser;
        if(!is_null($result)) {
            return $this->item($result, new UserActionTransformer);
        } return null;
    }
}
