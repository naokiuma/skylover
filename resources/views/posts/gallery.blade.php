@extends('layouts.app')

@section('content')
@if (session('flash_message'))
<div class="alert alert-primary text-center" id="dat" role="alert">
  {{ session('flash_message') }}
</div>
@endif
<div class="container">

  <h1><?php if($keyword)
  {
    echo "検索結果:".$keyword;
  }
  ?></h1>

  <?php
  $top_post = $posts[0];
  //$image_url = $top_post->image_url;
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
  <form method="POST" action="{{ route('posts.category')}}" class="billbord" enctype="multipart/form-data" >
    {{ csrf_field() }}

      <div class="form-group container-fruid">
      <label for="category_name" class="font-s">カテゴリで検索</label><br>
        <select class="font-s js-select-category" name="category_search">
          <option value="1" selected>明るい空</option>
          <option value="2">夕の空</option>
          <option value="3">雲</option>
          <option value="4">光景</option>
          <option value="5">人工の光景</option>
        </select>

      <button type="submit" class="btn btn-primary">
                  {{__('Seatch')}}
      </button>
      </div>
  </form>
</div>

  <div class="jumbotron jumbotron-fluid">
    <div class="container billbord">
      <h3 class="display-6 top_title"><?php echo $top_post->title ?></h3>
      <img src ="/{{ $image_url }}" class="img-fluid image-m top_main_img" alt="Responsive image"><br>
      <span class="ol_badge badge-pill badge-success top_main_category"><?php echo $top_post->category->category_name ?></span>
      <span class="time_info top_main_info"><?php echo $top_post->created_at ?>posted.</span>

    </div>
  </div>


    <div class="row justify-content-center">

                @foreach ($posts as $post)

                <?php $post_image = str_replace('public/', 'storage/', $post->image_url); ?>

                  <div class="col-12 col-sm-4 col-lg-2 each_post flexbox">

                      <div class="card card_add image_get">
                        <div class="img_whrapper">

                        <img src ="/{{ $post_image }}" class="img-fluid image-s image_active" alt="Responsive image">
                        <div class="mask">
                          <div class="caption">
                              {{ $post->title }}<br>
                              <a href="{{route('posts.show',$post->id) }}" class="btn badge-warning each_post__btn">{{ __('See post')}}</a>
                          </div>
                        </div>
                        </div>
                        <div class="card-body">
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
