<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;

/**
 * Class Permission.
 *
 * @package namespace App\Entities;
 */
class Permission extends EntrustPermission
{

    const CREATED_AT_FIELD  = 'created_at';
    const CREATED_BY_FIELD  = 'created_by';
    const UPDATED_AT_FIELD  = 'updated_at';
    const UPDATED_BY_FIELD  = 'updated_by';

    public $fillable = ['name','group_id', 'display_name_en','display_name_kh', 'description', 'created_by', 'created_at', 'updated_at', 'updated_by'];


}
