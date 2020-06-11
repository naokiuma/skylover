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
        //$fav =  DB::table('favs')->latest()->first();これだとダメ。
        Log::debug(print_r("結果だよ".$post, true));

        //ajax用ここから----------
        $fav = Fav::where('user_id', Auth::user()->id)->latest()->first();
        //$fav_id = Fav::all()->first();//これはダメ。最初のが来てしまう。       
        $data_arr = array($post, $fav);
        $datas = json_encode($data_arr);
        echo $datas;
        //ajax用ここまで----------

        //通常用ここから----------
        //return redirect()//ajaxではない場合
        //    ->action('PostsController@show',$post->id);
        //通常用ここまで----------
    }


    public function destroy($postId,$favId)
    {
        Log::debug("favsのdestroyコントローラーで処理を始めます");

        $delete_fav = Post::findOrFail($postId);//postidがあるかどうか判定
        $delete_fav->fav_by()->findOrFail($favId)->delete();
        $post = Post::findOrFail($postId);

        //ajax用ここから----------
        echo $post;

        //通常用ここから----------
        //return redirect()
        //    ->action('PostsController@show',$post->id);
        //通常用ここまで----------

    }

    public function search($userId)
    {
        Log::debug("favsのsearchコントローラーで処理を始めます");

        $authusers_fav = Fav::where('user_id',$userId)->get();
        $num = count($authusers_fav);//取得したfav数
        for($i = 0 ; $i < $num ; $i++){
            $post = Post::find($authusers_fav[$i]->post_id);

            $t_img_url = $post->image_url;
            $t_img_url = str_replace('public','storage',$t_img_url);//画像のurlのpublicをstrageに置き換える
            $img_urls[$i] = $t_img_url;

            //$img_urls[$i] = $post->image_url;
            Log::debug($img_urls[$i]);
            $post_id[$i] = $post->id;
            Log::debug($post_id[$i]);
        }
        //$result = array_merge( $img_urls, $post_id);
        //Log::debug($result);
        //echo $authusers_fav;
        $temp = array_combine($post_id,$img_urls);
        //$rst_img = json_encode($img_urls);
        //$rst_id = json_encode($post_id);
        $rst = json_encode($temp);
        echo $rst;

    }

}
