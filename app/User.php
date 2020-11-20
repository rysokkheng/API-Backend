<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable
{
    use HasApiTokens;
    use Notifiable;
    use HasRoles;


    const RECORD_STATUS_FIELD   = 'record_status_id';
    const RECORD_STATUS_ACTIVE  = 1;


    const CREATED_AT_FIELD = 'created_at';
    const CREATED_BY_FIELD = 'created_by';
    const UPDATED_AT_FIELD= 'updated_at';
    const UPDATED_BY_FIELD= 'updated_by';

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
        'roles','fullname', 'username', 'password', 'email', 'phone', 'organization',self::RECORD_STATUS_ACTIVE, self::RECORD_STATUS_FIELD,
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
        'email_verified_at' => 'datetime',
    ];
    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }




}
