@extends('layouts.app')

@section('content')

<div class="start">
  <h2>Have a nice <span>SKY!</span></h2>
</div>

<section class="top-billbord">
    <h1>空をシェアしよう。</h1>
    <p>空は、いつも違う顔を見せます。<br>
       あなただけが見た空を世界でシェアしよう。
    </p>
    @guest
    <button class="top-billbord_btn"><a href="{{ route('register') }}">早速登録する</a></button>
    @endguest
    

</section>

<section class="top-explain">
  <h2>3ステップで空を投稿しよう。</h2>
  <div class="step__wrapper">

    <div class="step__signup">
      <h3>1.登録する</h3>
    <i class="fab fa-twitter"></i>
    <p>※ツイッターアカウントがあればメールアドレスは不要です。</p>
    </div>

    <div class="step__photo">
      <h3>2.写真を撮る</h3>
      <img src="img/photo2.jpg" alt="">
    </div>

    <div class="step__post">
      <h3>3.投稿する</h3>
      <img src="img/post.jpg" alt="">
    </div>


  </div>
</section>

<h2 class="top-posts">投稿画像一覧</h2>
<p class="top-posts-p"><a href="{{ route('posts.gallery') }}">もっと見る</a></p>

<div class="container-fruid">
    <div class="top-eachposts">
                @foreach ($posts as $post)
                <?php $post_image = str_replace('public/', 'storage/', $post->image_url); ?>

                  <div class="top-eachpost image_get">

                  <div class="img_whrapper">
                      <img src ="./{{ $post_image }}" class="img-fluid image_active" alt="Responsive image">
                      <div class="mask">
                        <div class="caption">
                          <a href="{{route('posts.show',$post->id) }}" class="btn each_post__btn">{{ $post->title }} </a>
                        </div>
                      </div>
                  </div>

                  </div>
                  @endforeach

 </div>
</div>




<!--
<div class="container">

  <?php $num = mt_rand(0,1);
  $top_post = $posts[$num];
  //print_r($posts);
  //$image_url = $top_post->image_url;
  $image_url = str_replace('public/', 'storage/', $top_post->image_url);
  //print_r($top_post);
  //print_r($image_url);
  ?>


  <div class="jumbotron jumbotron-fluid">
    <div class="container billbord">
      <h3 class="display-6 top_title"><?php echo $top_post->title ?></h3>

      <img src ="./{{ $image_url }}" class="img-fluid image-m top_main_img" alt="Responsive image"><br>
      <span class="ol_badge badge-pill badge-success top_main_category"><?php echo $top_post->category->category_name ?></span>
      <span class="time_info top_main_info"><?php echo $top_post->created_at ?>posted.</span>

    </div>
  </div>

</div>

<div class="container-fruid">
    <div class="each_posts">
                @foreach ($posts as $post)
                <?php $post_image = str_replace('public/', 'storage/', $post->image_url); ?>

                  <div class="each_post image_get">

                  <div class="img_whrapper">
                      <img src ="./{{ $post_image }}" class="img-fluid image_active" alt="Responsive image">
                      <div class="mask">
                        <div class="caption">
                          <a href="{{route('posts.show',$post->id) }}" class="btn each_post__btn">{{ $post->title }} </a>
                        </div>
                      </div>
                      </div>
                  </div>
                  @endforeach

 </div>
</div>

-->
@endsection
