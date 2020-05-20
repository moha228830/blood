<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DonationReq extends Model
{
    protected $hidden = [

        "created_at",
        "updated_at"

   ];
    protected $table = 'donation_reqs';
    public $timestamps = true;
    protected $fillable = array('patient_name','client_id','age', 'patient_phone', 'city_id', 'blood_type_id', 'hospital_name','hospital_address', 'bags_num', 'longitude', 'latitude', 'details','client_id');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

    public function blood_type()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function  notify()
    {
        return $this->hasOne('App\Models\Notification');
    }



}
