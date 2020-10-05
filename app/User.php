<?php

namespace App;

use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Traits\PresentableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, EntrustUserTrait;

    const RECORD_STATUS_FIELD   = 'record_status_id';
    const RECORD_STATUS_ACTIVE  = 1;
    const RECORD_STATUS_DELETE  = 0;

    const CREATED_AT_FIELD = 'cdate';
    const CREATED_BY_FIELD = 'cby';
    const UPDATED_AT_FIELD= 'mdate';
    const UPDATED_BY_FIELD= 'mby';

    public $timestamps = false;

    protected $dates = [
        self::CREATED_AT_FIELD,
        self::UPDATED_AT_FIELD
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'username', 'password', 'role', 'email', 'phone', 'organization', self::RECORD_STATUS_FIELD,
        self::CREATED_AT_FIELD, self::CREATED_BY_FIELD, self::UPDATED_AT_FIELD, self::UPDATED_BY_FIELD,
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        self::CREATED_AT_FIELD, self::UPDATED_AT_FIELD,
    ];

    public function createUsers()
    {
        return $this->hasMany(User::class, 'cby', 'id');
    }

    public function updateUsers()
    {
        return $this->hasMany(User::class, 'mby', 'id');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'cby', 'id')->withDefault(function(){
            return new User();
        });
    }

    public function updatedByUser()
    {
        return $this->belongsTo(User::class, 'mby', 'id')->withDefault(function(){
            return new User();
        });
    }

    public function roles()
    {
        return $this->hasMany(UserRole::class, 'user_id', 'id');
    }
}
