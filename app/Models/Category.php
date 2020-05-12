<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $hidden = [

        "created_at",
        "updated_at"

   ];
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('category');

    public function posts ()
    {
        return $this->hasMany('App\Models\Post');
    }

}
