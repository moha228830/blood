<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'donation_req_id');

    public function for_patient()
    {
        return $this->hasOne('App/Models\DonationReq');
    }

}
