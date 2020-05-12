<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $hidden = [

         "created_at",
         "updated_at"

    ];
    protected $table = 'cities';
    public $timestamps = true;
    protected $fillable = array('name', 'govern_id');

    public function govern()
    {
        return $this->belongsTo('App\Models\Govern');
    }
    public function clients ()
    {
        return $this->hasMany('App\Models\Client');
    }

}
