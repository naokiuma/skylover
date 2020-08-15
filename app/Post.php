<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Fav;

class Post extends Model
{
    protected $guarded = ['id'];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function category(){
      return $this->belongsTo('App\Category');
    }

    public function favs(){
      return $this->hasMany('App\Fav');

    }

    public function fav_by(){
      return Fav::where('user_id',Auth::user()->id)->first();
    }

    protected $casts = [
      'id' => 'integer',
      'title' => 'string'
    ];

}
