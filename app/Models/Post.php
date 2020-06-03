<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $hidden = [

        "created_at",
        "updated_at"

   ];
    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'img', 'content', 'category_id');
    protected $appends = [   "img_full_path","is_favorite" ,"is_favori"  ] ;


    public function  category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

    public function   getIsFavoriteAttribute()
    {
        $favorite = request()->user()->whereHas("favorite",function($q){
       $q->where("client_post.post_id",$this->id);
    })->first();

        if($favorite){
            return true ;
        }else{
            return false ;
        }
    }


    public function   getIsFavoriAttribute()
    {
        $favorite = auth()->guard('clients')->user()->whereHas("favorite",function($q){
       $q->where("client_post.post_id",$this->id);
    })->first();

        if($favorite){
            return true ;
        }else{
            return false ;
        }
    }

    public function  getImgFullPathAttribute()
    {
        return asset($this->img) ;
    }



}
