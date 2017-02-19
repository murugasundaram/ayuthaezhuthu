<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class TenantComments extends Model
{
    protected $table = 'saas_tenant_comments';

    public function tenants()
    {
        return $this->belongsTo('App\Tenant');
    }

    /**
     * Add new comment
     *
     * @param array $data
     * @return integer $id
     */
    public static function add($data)
    {
        $user_id = Auth::id();
        $comment = new TenantComments();
        $comment->status = $data['status'];
        $comment->tenant_id = $data['tenant_id'];
        $comment->added_by = $user_id;
        $comment->comment_description = $data['comment_description'];
        $comment->save();
        return $comment->id;
    }
}
