<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'donation_req_id',"content");
    protected $hidden = [

        "created_at",
        "updated_at"

   ];
    public function  donation()
    {
        return $this->hasOne('App\Models\DonationReq');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }


}
