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
    <a href="{{ route('register') }}" class="top-billbord_btn">さっそく登録する</a>
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
<h2 class="top-posts content-lead">投稿画像一覧</h2>
<p class="top-posts-p"><a href="{{ route('posts.gallery') }}">もっと見る</a></p>



 <div class="container-fruid">
    <div class="top-eachposts loopSlider">
      <ul>
      @foreach ($posts as $post)
      <?php $post_image = str_replace('public/', 'storage/', $post->image_url); ?>
        <div class="top-eachpost image_get js-eachpost">
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
      </ul>
   </div>
</div>





@endsection
