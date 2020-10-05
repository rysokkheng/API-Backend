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
class UserRole extends BaseModel
{
    public $timestamps = false;

    protected $table = 'role_user';
    protected $fillable = ['user_id', 'role_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }


}
