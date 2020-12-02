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
class Role extends EntrustRole
{
    const CREATED_AT_FIELD  = 'created_at';
    const CREATED_BY_FIELD  = 'created_by';
    const UPDATED_AT_FIELD  = 'updated_at';
    const UPDATED_BY_FIELD  = 'updated_by';

    public $fillable = ['name', 'display_name', 'description','guard_name', 'created_by', 'created_at', 'updated_at', 'updated_by'];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id')->withDefault(function(){
            return new User();
        });
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id')->withDefault(function(){
            return new User();
        });;
    }

    public function permissions()
    {
        return $this->hasMany(RolePermission::class, 'role_id', 'id');
    }

}
