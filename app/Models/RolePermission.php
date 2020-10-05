<?php

namespace App\Models;

use App\Traits\HasTimestamps;
use App\User;
use Zizaco\Entrust\EntrustRole;

/**
 * Class Role.
 *
 * @package namespace App\Entities;
 */
class RolePermission extends BaseModel
{
    public $timestamps = false;

    protected $table = 'permission_role';
    protected $fillable = ['permission_id', 'role_id'];


}
