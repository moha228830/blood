<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Govern extends Model
{

    protected $hidden = [

        "created_at",
        "updated_at"

   ];
    protected $table = 'governs';
    public $timestamps = true;
    protected $fillable = array('name');

    public function cities ()
    {
        return $this->hasMany('App\Models\City');
    }
    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}


