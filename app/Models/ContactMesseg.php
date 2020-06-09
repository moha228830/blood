<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMesseg extends Model
{

    protected $table = 'contact_messegs';
    public $timestamps = true;
    protected $fillable = array('title', 'content',"client_id");
    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

}
