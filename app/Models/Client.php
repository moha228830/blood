<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Client extends Authenticatable
{

    protected $hidden = [
        'password',
        'api_token',
        'pin_code',
         "created_at",
         "updated_at"

    ];
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('username', 'date_of_birth', 'password', 'blood_type_id', 'city_id', 'last_donation', 'phone', 'email');

    public function blood_type()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
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


}
