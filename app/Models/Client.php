<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Client extends Authenticatable
{
   // protected $guard = 'clients';
    protected $hidden = [
        'password',
        'api_token',
        'pin_code',
         "created_at",
         "updated_at",
         "device_token"

    ];
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('username',"activity" ,'date_of_birth', 'password', 'blood_type_id',
     'city_id', 'last_donation', 'phone', 'email',"api_token","pin_code","device_token");
    protected $appends = [ "date"  ] ;

    public function blood_type()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function donationReqs()

    {
        return $this->hasMany('App\Models\DonationReq');
    }

    public function favorite()
    {
        return $this->belongsToMany('App\Models\Post');
    }

    public function notification()
    {
        return $this->belongsToMany('App\Models\Govern');
    }

    public function notificate()
    {
        return $this->belongsToMany('App\Models\BloodType');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification')->withPivot('is_read');;
    }

    public function tokens ()
    {
        return $this->hasMany('App\Models\Token');
    }

    public function contacts ()
    {
        return $this->hasMany('App\Models\ContactMesseg');
    }
    public function  getDateAttribute()
    {
      return date("Y-m-d", strtotime($this->created_at));
    }



}
