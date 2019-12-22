<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
//use Illuminate\Support\Arr;
use App\Post;
use App\Category;

use Illuminate\Support\Facades\DB; 
//これ参考 https://readouble.com/laravel/5.7/ja/queries.html

//use App\Http\Requests\HelloRequest;
//あとでつける。

class PostsController extends Controller
{
  public function index (){
    $posts = Post::all();
    //変数に値を渡したい場合第二引数で設定。この場合、postsに値が入る
    //なお、変数に同じ値を入れる設定としてcombineもあり。その場合 ('drills.index',combine('drills'));となる。

    return view ('top',compact('posts'));
  }


//------------------新規作成ページ
  public function new()
  {
    $posts = Post::all();

    return view ('posts.new',compact('posts'));
  }

  //------------------新規作成post

  public function create(Request $request)
  {
    $post = new Post;
    $time = date("YmdHis");
    //バリデート（あとでミドルウェアに移す）
    $this->validate($request,[
      'title' => 'required|string|max:255',
      'category_id' => 'required|string|max:255',
      'image_url' => 'max:2048',
    ]);

    //元々のもの
    //Auth::user()-posts()->save($drill->fill($request->all()));

    //storage/app/publicの中に保管
    $post->image_url = $request->image_url->storeAs('public/post_images', $time.'_'.Auth::user()->id.'.jpg');
    $post->title = $request->title; //インスタンスのタイトルに、リクエストのタイトルを入れる
    //$post->content = $request->content;
    $post->category_id = $request->category_id;
    //Log::debug(print_r("postの中身だよ！".$post, true));
    Auth::user()->posts()->save($post);


    //$post->fill($request->all())->save();
    return redirect('/')->with('flash_message',__('Registered.'));
  }

//------------------閲覧ページ

public function show($id){
  //事前にgetパラメータかどうかをチェックする。ことで、dbへの無駄なアクセスが減らせる。
  //(webサーバーへのアクセスのみですむ)
  if(!ctype_digit($id)){
    return redirect('/')->with('flash_message',__('Invalid operation was performed.'));
  }

  $post = Post::find($id);
  return view('posts.show',compact('post'));

  }


//------------------キーワードで検索ページ

public function gallery(){

  $posts = Post::all();
  //Log::debug(print_r("結果だよ".$posts, true));
  $keyword = '';
  //$select_category ='';

  return view ('posts.gallery',compact('posts','keyword'));
}

//------------------キーワード検索アクション

public function search(Request $request){
 $keyword = $request->input('keyword');
 $posts = Post::where('title','LIKE',"%{$keyword}%")->get();
 Log::debug(print_r("結果".$posts , true));

 if(empty($posts)){
   $posts = Post::all();
   return view ('posts.gallery',compact('posts','keyword'))->with('flash_message',__('一致する結果がありませんでした。全投稿を表示します。'));
 };
return view ('posts.gallery',compact('posts','keyword'));
}


public function category(){
  //$posts_morning = json_encode(Post::where('category_id',1)->get(),JSON_UNESCAPED_UNICODE);
  $posts_morning = Post::where('category_id',1)->get();
  $posts_daytime = Post::where('category_id',2)->get();
  $posts_night = Post::where('category_id',3)->get();

  return view ('posts.category',compact('posts_morning','posts_daytime','posts_night'));
}

/*
//------------------カテゴリ検索アクション

public function category(Request $request){
 $keyword = '';
 $category_search = $request->input('category_search');
 //Log::debug(print_r("idだよ".$category_search, true));

 $posts = Post::where('category_id',$category_search)->get();
 //Log::debug(print_r("結果だよ".$posts, true));

 $count = count($posts);
 //Log::debug(print_r("投稿数".$count, true));

 if($count < 1){//メモ：投稿がないときにはemptyで判定すると変数= ''もあるとみなしてしまうので、count関数で数を見たほうが良さげ
//Log::debug(print_r("結果はなし！".$posts, true));
   $posts = Post::all();
   return view ('posts.gallery',compact('posts','keyword'))->with('flash_message',__('一致する結果がありませんでした。全投稿を表示します。'));
 };
//Log::debug(print_r("結果はあり！".$posts, true));
return view ('posts.gallery',compact('posts','keyword'));
}
*/


//------------------ニュース一覧アクション
public function news(){
    set_time_limit(90);
    $max_num = 3;
    $keywords = "天気";

    //---- キーワード検索したいときのベースURL
    $API_BASE_URL = "https://news.google.com/news?hl=ja&ned=ja&ie=UTF-8&oe=UTF-8&output=atom&q=";
    //----キーワードの文字コード変更
    $query = urlencode(mb_convert_encoding($keywords,"UTF-8", "auto"));

    //---- APIへのリクエストURL生成
    $api_url = $API_BASE_URL.$query;
    //Log::debug(print_r("api_urlです".$api_url));

    //---- APIにアクセス、結果をsimplexmlに格納
    $contents = file_get_contents($api_url);
    $xml = simplexml_load_string($contents);


    //print_r($xml);
    $list = [];




    //記事エントリを取り出す
    $data = $xml->entry;
    //print_r($data);

    //記事のタイトルとURLを取り出して配列に格納
    for ($i = 0; $i < count($data); $i++) {

        $list[$i]['title'] = mb_convert_encoding($data[$i]->title ,"UTF-8", "auto");
        $url_split =  explode("=", (string)$data[$i]->link->attributes()->href);
        $list[$i]['url'] = end($url_split);


    }
    //Log::debug(print_r($list));

    //$max_num以上の記事数の場合は切り捨て
    if(count($list)>$max_num){
        for ($i = 0; $i < $max_num; $i++){
            $list_gn[$i] = $list{$i};
            $i++;
        }
        //Log::debug(print_r($list_gn));

    }else{
        $list_gn = $list;
        //Log::debug(print_r($list_gn));
        //Log::debug(print_r("list_gnの中身2".$list_gn, true));

    }

    //配列を出力
    //return $list_gn;
  return view('news');
  //return view('news',compact('list_gn'));
}




}
