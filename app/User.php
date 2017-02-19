<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $table = 'saas_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relating User with Organisation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function organisation()
    {
        return $this->hasOne('App\Tenant', 'id', 'organisation_id');
    }

    /**
     * Return bool if current logged in user is Super Admin
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return $this->attributes['is_super_admin'] == 1 ? true : false;
    }

}
