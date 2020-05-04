<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = ['id'];

    public function user(){
      return $this->belongsTo('App\User');
    }

    public function category(){
      return $this->belongsTo('App\Category');
    }
/*
    public static function getnewposts(){
      return Post::orderBy('id','DESC')->take(3)->get();//最新の5件を得る
    }
    */
}
