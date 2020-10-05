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
            'role'      => (string) $model->role,
            'email'     => (string) $model->email,
            'phone'     => (string) $model->phone,
            'organization'  => (int) $model->organization,
            'status'    => (int) $model->status,
            'created_at'=> Helpers::isDateValid($model->cdate) ? $model->cdate->format(DateFormatEnum::dMYHi) : null,
            'updated_at'=> Helpers::isDateValid($model->mdate) ? $model->mdate->format(DateFormatEnum::dMYHi) : null,
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
