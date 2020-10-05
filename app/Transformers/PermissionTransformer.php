<?php

namespace App\Transformers;

use App\Enums\DateFormatEnum;
use App\Helpers\Helpers;
use Illuminate\Support\Facades\App;
use App\Models\Permission;
use App\User;
use League\Fractal\TransformerAbstract;

/**
 * Class UserTransformer.
 *
 * @package namespace App\Transformers;
 */
class PermissionTransformer extends TransformerAbstract
{

    /**
     * Transform the User entity.
     *
     * @param \App\Models\User $model
     *
     * @return array
     */
    public function transform(Permission $model)
    {

        return [
            'id'        => (int) $model->id,
            'name'  => (string) $model->name,
            'display_name_en'  => (string) (App::getLocale() == 'kh' ? $model->display_name_kh : $model->display_name_en),
            'description'      => (string) $model->description,
            'created_at'=> Helpers::isDateValid($model->created_at) ? $model->created_at->format(DateFormatEnum::dMYHi) : null,
            'updated_at'=> Helpers::isDateValid($model->updated_at) ? $model->updated_at->format(DateFormatEnum::dMYHi) : null,
        ];
    }


}
