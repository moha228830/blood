<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    protected $hidden = [

        "created_at",
        "updated_at"

   ];
    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('blood_type');

    public function notificate()
    {
        return $this->belongsToMany('App\Models\Client');
    }
    public function clients ()
    {
        return $this->hasMany('App\Models\Client');
    }

    public function donations ()
    {
        return $this->hasMany('App\Models\donationReq');
    }

}
