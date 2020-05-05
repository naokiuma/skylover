<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use kanazaca\CounterCache\CounterCache;

class Fav extends Model
{
    use CounterCache;

    public $counterCacheOptions = [//クラス内変数
        'Post' =>[//テーブルのfavs_countに対しての処理
            'field' => 'favs_count',
            'foreignKey' => 'post_id'

        ]
    ];

    protected $fillable = ['user_id', 'post_id'];

    public function Post()
    {
        return $this->belongsTo('App\Post');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }




}
