<?php

namespace App;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = [];
    protected $fillable = ['name','display_name','description'];
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

}
