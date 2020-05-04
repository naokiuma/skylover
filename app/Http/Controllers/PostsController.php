<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB; 
use App\Http\Requests\HelloRequest;

use App\Post;
use App\Category;
//参考 https://readouble.com/laravel/5.7/ja/queries.html


class PostsController extends Controller
{
  public function index (){
    //$users = Post::latest()->get();でも同じ
   $posts = Post::orderBy('created_at', 'desc')->take(4)->get();
   //$test = Post::getnewposts();
   // $posts = Post::all()
   //Log::debug(print_r("結果".$posts, true));
   //変数に値を渡したい場合第二引数で設定。この場合、postsに値が入る
   //なお、変数に同じ値を入れる設定としてcombineもあり。その場合 ('drills.index',combine('drills'));となる。
    return view ('top',compact('posts'));
  }


//------------------新規作成ページ
  public function new()
  {
    return view ('posts.new');
  }

  //------------------新規作成post

  public function create(Request $request){
    $post = new Post;
    $time = date("YmdHis");

    //元々のSQLもの
    //Auth::user()-posts()->save($drill->fill($request->all()));
    //storage/app/publicの中に保管
    $post->image_url = $request->image_url->storeAs('public/post_images', $time.'_'.Auth::user()->id.'.jpg');
    $post->title = $request->title; //インスタンスのタイトルに、リクエストのタイトルを入れる
    $post->category_id = $request->category_id;
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
        $user = Auth::user();
  $post = Post::find($id);
    
  return view('posts.show',compact('post','user'));
}

//------------------削除アクション

public function destroy($id){

  if(!ctype_digit($id)){
    return redirect('/')->with('flash_message', __('Invalid operation was performed.'));
  }
  Post::find($id)->delete();
  return redirect('posts/gallery')->with('flash_message', __('削除しました！'));

}



//------------------キーワードで検索ページ

public function gallery(){
  $posts = Post::orderBy('created_at', 'desc')->get();
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
 Log::debug(count($posts));

 if(count($posts) === 0){
   $posts = Post::all();
   return view ('posts.gallery',compact('posts','keyword'))->with('flash_message',__('一致する結果がありませんでした。全投稿を表示します。'));
 }
return view ('posts.gallery',compact('posts','keyword'));
}

//------------------カテゴリーで振り分けページ

public function category(){
  
  //$posts = Post::orderBy('created_at', 'desc')->get();

  $posts_morning = Post::where('category_id',1)->orderBy('created_at', 'desc')->get();
  $posts_daytime = Post::where('category_id',2)->orderBy('created_at', 'desc')->get();
  $posts_night = Post::where('category_id',3)->orderBy('created_at', 'desc')->get();
  return view ('posts.category',compact('posts_morning','posts_daytime','posts_night'));
}


}
