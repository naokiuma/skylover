<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Http\Requests;
use App\Fav;
use Auth;
use App\Post;

class FavsController extends Controller
{
    public function store(Request $request,$postId)
    {
        Log::debug("favsのstoreコントローラーで処理を始めます");
        Fav::create(
            array(
                'user_id' => Auth::user()->id,
                'post_id' => $postId
            )
        );

        $post = Post::findOrFail($postId);

        //echo true;//ajaxにする場合の追加文章

        return redirect()//ajaxではない場合
            ->action('PostsController@show',$post->id);
    }


    public function destroy($postId,$favId)
    {
        $post = Post::findOrFail($postId);//postidがあるかどうか判定
        $post->fav_by()->findOrFail($favId)->delete();

        return redirect()
            ->action('PostsController@show',$post->id);

    }
}
