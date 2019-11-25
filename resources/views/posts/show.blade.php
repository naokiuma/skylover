@extends('layouts.app')


@section('content')
<div class="container">

  <?php
  $image_url = str_replace('public/', 'storage/', $post->image_url);
  ?>


  <div class="jumbotron-fluid">
    <div class="container billbord">
      <h3 class="display-6 top_title"><?php echo $post->title ?></h3>
      <img src ="/{{ $image_url }}" class="img-fluid image-l top_main_img" alt="Responsive image"><br>
      <span class="ol_badge badge-pill badge-success top_main_category"><?php echo $post->category->category_name ?></span>
      <span class="time_info top_main_info"><?php echo $post->created_at ?>posted.</span>

    </div>
  </div>

</div>

@endsection
