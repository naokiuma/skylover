@extends('layouts.app')


@section('content')
<div class="header-sp-space">
</div>

<div class="container">
  <?php
  $image_url = str_replace('public/', 'storage/', $post->image_url);
  ?>

  <div class="jumbotron-fluid">
    <div class="container billbord">
      <h3 class="display-6 top_title"><?php echo $post->title ?></h3>
      <img src ="../{{ $image_url }}" class="img-fluid image-l top_main_img" alt="Responsive image"><br>
      <span class="ol_badge badge-pill badge-success top_main_category"><?php echo $post->category->category_name ?></span>
      <span class="time_info top_main_info"><?php echo $post->created_at ?>posted.</span>
      <!--お気に入り
      <i class="fas fa-star icon-star"></i><span class="favs-count"><?php echo $post->favs_count ?></span>
      -->

    </div>
  </div>

@if( Auth::check() )
    
  <?php if($user->id == $post->user_id) :?>

    <form action="{{ route('posts.delete',$post->id ) }}" method="post" class="d-inline">
      @csrf
      <button class="btn btn-danger" onclick='return confirm("削除しますか？");'>{{ __('Go Delete')  }}</button>
    </form> 

  <?php endif; ?>

@endif

</div>

<!--お気に入り機能。調整中
@if (Auth::check())
    @if ($fav)
    <div class="js-click-wrap">
      <button class="js-clicked-like">お気に入り済み</button>
    </div>

    
    <form action="{{ route('favs.destroy',[$post->id,$fav->id]) }}" method="post" class="d-inline">
      @csrf
      <button class="btn btn-danger" onclick='return confirm("削除しますか？");'>お気に入り済み</button>
    </form>
    

    @else
    ajaxの場合
    <div class="js-click-wrap">
      <button class="js-click-like">お気に入り</button>
    </div>

    ajaxしない場合
    <form action="{{ route('favs.store',$post->id) }}" method="post" class="d-inline">
      @csrf
      <button class="btn" onclick='return confirm("お気に入りにしますか？");'>お気に入りにする</button>
    </form>
    

    @endif
  @endif
  -->



<!--//ajax用スクリプと

<script>
//favするためのurl
const postid = @json($post)['id'];
//console.log(postid);
const url = `/posts/${postid}/favs`


//favがすでにある場合の取り消し用のurl
//コントローラーから値が来ている場合
if(@json($fav)){
  let fav_date = @json($fav);
  console.log("favのなかみ");
  console.log(fav_date);
  const favid = @json($fav)['id'];
  console.log("favidです");
  console.log(favid);
  
  const deleteurl = `/posts/${postid}/favs/${favid}`
}

//こういう方法もある
//obj = JSON.parse(postid);
//console.log(obj);


window.addEventListener('DOMContentLoaded', function(){
  $('.js-click-like').on('click',function(e){
    console.log("どうでしょう");
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
            $('.js-click-wrap').html('<button class="js-clicked-like">お気に入り済み</button>');


        }).fail(function( msg ){
            console.log('Ajax Error');
            console.log(msg);
        });
  });
});


</script>
-->

@endsection


