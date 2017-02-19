<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'saas_tenants';

    public static $prefix_route = 'nirvakam/kattupattuarai';

    /**
     * Relating Comments with Tenants
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany('App\TenantComments');
    }

    /**
     * Relating Organisation with User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo('App/User', 'organisation_id', 'id');
    }
}
