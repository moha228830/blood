<?php

namespace App/Models;

use Illuminate\Database\Eloquent\Model;

class DonationReq extends Model 
{

    protected $table = 'donation_reqs';
    public $timestamps = true;
    protected $fillable = array('patient_name', 'patient_phone', 'city_id', 'blood_type_id', 'hospital_name', 'donation_ago', 'hospital_address', 'bags_num', 'longitude', 'latitude', 'details');

    public function from_city()
    {
        return $this->belongsTo('App/Models\City');
    }

    public function has_blood_type()
    {
        return $this->belongsTo('App/Models\BloodType');
    }

}