@extends('layouts.app')

@section('content')
<div class="container">



  <?php $num = mt_rand(0,4);
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
    <div class="row justify-content-center">

                @foreach ($posts as $post)
                <?php $post_image = str_replace('public/', 'storage/', $post->image_url); ?>

                  <div class="col-sm-2 each_post">
                    <div class="card card_add image_get">
                      <div class="img_whrapper">
                      <img src ="./{{ $post_image }}" class="img-fluid image-s image_active" alt="Responsive image">
                      <div class="mask">
                        <div class="caption">
                            {{ $post->title }}
                            
                            
                        </div>
                      </div>
                      </div>


                      <div class="card-body">
                        <a href="{{route('posts.show',$post->id) }}" class="btn btn-primary each_post__btn">{{ __('See post')}}</a>
                        <p class="ol_badge badge-pill badge-success js-category each_post__btn">{{ $post->category->category_name }}</p>
                        <span style="display:none;" class="js-post_data">
                          {{ $post->created_at }}
                          
                        </span>

                        <!--
                        @if (Auth::user())
                        <a href="" class="btn btn-warning">{{ __('Edit')}}</a>
                        @endif
                        -->
                      </div>
                    </div>
                  </div>

                  @endforeach


</div>
</div>
@endsection
