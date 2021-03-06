@extends('layouts.app')

@section('content')

<section class="jumbotron">
<!--
@if(count($errors) > 0)
 <div class="error">
   <ul>
     @foreach($errors->all() as $error)
       <li>{{ $error }}</li>
     @endforeach
   </ul>
 </div>
@endif
-->

<div class="col-sm-12">
<form method="POST" action="{{ route('posts.create')}}" class="billbord" enctype="multipart/form-data" >
  {{ csrf_field() }}

<!--タイトル-->
    <div class="form-group center">
    <label for="title" class="font-m">{{ __('Title') }}</label><br>
      <input type="text" name="title" value="{{old('title')}}"
      autocomplete="title" autofocus>
      <br>
      @if ($errors->has('title'))
      <span class="post-warn" role="alert">
        <strong>{{ __('タイトルを入力してください。') }}</strong>
      </span>
      @endif
    </div>


  <!--画像投稿オリジナル-->
    <div class="form-group center">
      <span class="font-m center">画像投稿</span>
    <div class="form-image_url drag-drop-area"><!--ドラッグエリア-->
      <input id="fileInput" class="drag-space" type="file" value="{{old('image_url')}}" name="image_url">
      <img class="preview-cover"></div>
    </div>
      @if ($errors->has('image_url'))
      <span class="post-warn" role="alert">
        <strong>{{ __('画像が設定されていません。') }}</strong>
      </span>
      @endif
    </div>


<!--カテゴリネーム-->
    <div class="form-group category-group">
    <label for="category_name" class="font-s">{{__('Category')}}</label><br>
      <select class="" name="category_id">
        <option value="1" selected>朝の空</option>
        <option value="2">日中の空</option>
        <option value="3">夜の空</option>
      </select>
    </div>
    <div class="submit-btn">
    <button type="submit" class="btn btn-primary">
                {{__('Post')}}
    </button>
    </div>


</form>

</div>
</section>


@endsection
