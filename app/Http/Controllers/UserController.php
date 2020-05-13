<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\Category;
use App\Fav;

class UserController extends Controller
{
    public function index (){
        $user = Auth::user();//ユーザー情報

        //$userid = $user->id;//ok
        //Log::debug($userid);
        //$posts = Post::Where('user_id', '$userid')->get();//これでは取得できない
        //Query Time:1.96s] select * from `users` where `id` = ? limit 1 

        $posts = $user -> posts()->get();//これでは取得できる
        //Query Time:17.88s] select * from `posts` where `posts`.`user_id` = ? and `posts`.`user_id` is not null
        //Log::debug(print_r("結果".$posts , true));

        //マイページでポスト情報を渡す
        //return view('user.mypage',compact('user','posts'));
        return view('user.mypage',compact('posts'));
    }

    public function getFav(){
        $user = Auth::user();
        $user_favs = Fav::Where('user_id','$user->id');
        return $user_favs;
    }

 
}
