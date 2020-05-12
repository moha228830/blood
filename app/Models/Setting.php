<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $hidden = [

        "created_at",
        "updated_at"

   ];
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('setting_notification_text', 'about_app', 'contact_phone', 'contact_email', 'fb_link', 'tw_link', 'insta_link', 'yt_link');

}
