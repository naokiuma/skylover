@extends('layouts.app')


@section('content')
<div class="header-sp-space">
</div>

<div class="show-container">
  <?php
  $image_url = str_replace('public/', 'storage/', $post->image_url);
  ?>

  <!--<div class="jumbotron-fluid">-->
    <div class="show-billbord">
      <h3 class="display-6 top_title"><?php echo $post->title ?></h3>
      <img src ="../{{ $image_url }}" class="img-fluid image-l top_main_img" alt="Responsive image"><br>
      <span class="ol_badge badge-pill badge-success top_main_category"><?php echo $post->category->category_name ?></span>
      <span class="time_info top_main_info"><?php echo $post->created_at ?>posted.</span>
      <!--お気に入り-->
      <i class="fas fa-star icon-star"></i><span class="favs-count"><?php echo $post->favs_count ?></span>

<!--お気に入り機能-->
@if (Auth::check())
    @if ($fav)
    <!--favありの場合。ajax-->
    <div class="js-click-wrap">
      <button class="like-button js-clicked-like">お気に入り済み</button>
    </div>

    <!--favありの場合。ajaxではない
    <form action="{{ route('favs.destroy',[$post->id,$fav->id]) }}" method="post" class="d-inline">
      @csrf
      <button class="btn btn-danger" onclick='return confirm("削除しますか？");'>お気に入り済み/通常</button>
    </form>
    -->
    
    @else
    <!--ajaxの場合-->
    <div class="js-click-wrap">
      <button class="like-button js-click-like">お気に入りする</button>
    </div>

    <!--ajaxではない場合
    <form action="{{ route('favs.store',$post->id) }}" method="post" class="d-inline">
      @csrf
      <button class="btn" onclick='return confirm("お気に入りにしますか？");'>お気に入りにする</button>
    </form>
    -->
    
    @endif
@endif
  

      

  </div>
<!--</div>-->


@if( Auth::check() )
  <?php if($user->id == $post->user_id) :?>

    <form action="{{ route('posts.delete',$post->id ) }}" method="post" class="d-inline">
      @csrf
      <button class="btn btn-danger" onclick='return confirm("削除しますか？");'>{{ __('Go Delete')  }}</button>
    </form> 

  <?php endif; ?>
@endif
</div>


<!--//ajax用スクリプと-->

<script>
let postid = @json($post)['id'];
console.log(postid);//該当ポストのid
//favするためのurl
var url = `/posts/${postid}/favs`
var return_fav_id;

//favがすでにある状態で、このページを読み込んだ場合の処理。
//コントローラーからfavの値が来ている場合はこの処理。
if(@json($fav)){
  let fav_date = @json($fav); //この場合は、このfavidを使う。
  console.log("favのなかみ");
  console.log(fav_date);
  var favid = @json($fav)['id'];
  console.log("favidです");
  console.log(favid);
}

//http://shanabrian.com/web/html-css-js-technics/js-bug-ie-02.php
$.ajaxSetup({
    beforeSend : function(xhr) {
        xhr.overrideMimeType('text/html;charset=Shift_JIS');
    }
});

//------------------------------------
//お気に入り処理1
$(document).on('click', '.js-click-like', function(e){
  //http://creator.aainc.co.jp/archives/6611#section3 　後から追加したコンテンツでの操作
//$('.js-click-like').on('click',function(e){ 
    console.log("お気に入りします。");
    e.preventDefault();
    $.ajax({
      type: "get",
      url: url,
      dataType:'json',
      data: { postid : postid}
        }).done(function( result ){
            console.log('Ajax Success');
            console.log(result);
            console.log(result[0].favs_count);
            $('.favs-count').text(result[0].favs_count);
            $('.js-click-wrap').html('<button class="like-button js-clicked-like">お気に入り済み</button>');
            //お気に入りした場合に帰ってくるfav情報。同じ画面でそのまま削除する場合は、このreturn_fav_idを使う。
            return_fav_id = result[1].id;
            console.log("今回取得したfavです。")
            console.log(return_fav_id);
        }).fail(function( msg ){
            console.log('Ajax Error');
            console.log(msg);
        });
  });

//お気に入りを外す処理2。
$(document).on('click', '.js-clicked-like', function(e){
//$('.js-clicked-like').on('click',function(e){
  console.log("今回取得したfavです。")
  console.log(return_fav_id);
e.preventDefault();
//読み込みの時点でfavidがある場合。
if(return_fav_id){
  var deleteurl = `/posts/${postid}/favs/${return_fav_id}`
  console.log("最初からfavされていました。deleteurlです。");
  console.log(deleteurl);
  favid = " ";
  }else if(favid){
    var deleteurl = `/posts/${postid}/favs/${favid}`
    console.log("あとからfavされました。deleteurlです。");
    console.log(deleteurl);
  }

  console.log("ajax直前のdeleteurlです。");
  console.log(deleteurl);

  $.ajax({
      type: "get",
      url: deleteurl,
      dataType:'json',
      data: { postid : postid,
              favid : favid      
            }
        }).done(function( result ){
            console.log('deletet Ajax Success');
            console.log(result);
            console.log(result.favs_count);
            $('.favs-count').text(result.favs_count);
            $('.js-click-wrap').html('<button class="like-button js-click-like">お気に入りする</button>');
        }).fail(function( msg ){
            console.log('Ajax Error');
            console.log(msg);
        });
})



</script>


@endsection


