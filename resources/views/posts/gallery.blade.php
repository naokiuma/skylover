@extends('layouts.app')

@section('content')
@if (session('flash_message'))
<div class="alert alert-primary text-center" id="dat" role="alert">
  {{ session('flash_message') }}
</div>
@endif
　

<div>

  <h2><?php if($keyword)
  {
    echo "検索結果:".$keyword;
  }
  ?></h2>

  <?php
 // var_dump($posts);
 //print_r($posts);
  $top_post = $posts[0];
  $image_url = str_replace('public/', 'storage/', $top_post->image_url);

  ?>

  <div class="col-sm-12">
  <form method="POST" action="{{ route('posts.search')}}" class="billbord" enctype="multipart/form-data" >
    {{ csrf_field() }}

  <!--ギャラリーでの検索-->
      <div class="form-group container-fruid">
      <label for="title" class="font-m">キーワードで検索</label><br>
        <input type="text"name="keyword" autocomplete="title" autofocus>
      <button type="submit" class="btn btn-primary">
                  {{__('Seatch')}}
      </button>
      </div>
  </form>


  <div class="jumbotron jumbotron-fluid">
    <div class="container billbord">
      <h3 class="display-6 top_title"><?php echo $top_post->title ?></h3>
      <img src ="../{{ $image_url }}" class="img-fluid image-m top_main_img" alt="Responsive image"><br>
      <span class="ol_badge badge-pill badge-success top_main_category"><?php echo $top_post->category->category_name ?></span>
      <span class="time_info top_main_info"><?php echo $top_post->created_at ?>posted.</span>

    </div>
  </div>


    <div class="each_posts">

                @foreach ($posts as $post)

                <?php $post_image = str_replace('public/', 'storage/', $post->image_url); ?>

                  <div class="each_post">

                      <div class="card card_add image_get">
                        <div class="img_whrapper">

                        <img src ="../{{ $post_image }}" class="img-fluid image-s image_active" alt="Responsive image">
                        <div class="mask">
                          <div class="caption">
                              <a href="{{route('posts.show',$post->id) }}">{{ $post->title }}</a>
                          </div>
                        </div>
                        </div>
                        <div>
                          <p class="ol_badge badge-pill badge-success js-category each_post__btn">{{ $post->category->category_name }}</p>
                          <span style="display:none;" class="js-post_data">
                            {{ $post->created_at }}
                          </span>
                        </div>
                      </div>


                    </div>
                  @endforeach
</div>
</div>

@endsection
