<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientGovern extends Model
{

    protected $table = 'client_govern';
    public $timestamps = true;
    protected $fillable = array('client_id', 'govern_id');

}
