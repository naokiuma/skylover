@extends('layouts.app')

@section('content')

<section class="jumbotron">


<div class="col-sm-12">
<form method="POST" action="{{ route('posts.create')}}" class="billbord" enctype="multipart/form-data" >
  {{ csrf_field() }}

<!--タイトル-->
    <div class="form-group">
    <label for="title" class="font-m">{{ __('Title') }}</label><br>
      <input type="text"name="title" value="{{old('title')}}"
      autocomplete="title" autofocus>
      @if ($errors->has('title'))
      <span class="" role="alert">
        <strong>{{ __('タイトルを入力してください。') }}</strong>
      </span>
      @endif
    </div>


<!--画像投稿-->
    <div class="form-group">
      <span class="font-m">画像投稿</span>
    <div class="form-image_url">
      <input type="file" name="image_url">
    </div>
    </div>

<!--カテゴリネーム-->
    <div class="form-group">
    <label for="category_name" class="font-s">{{__('Category')}}</label><br>
      <select class="" name="category_id">
        <option value="1" selected>朝の空</option>
        <option value="2">日中の空</option>
        <option value="3">夜の空</option>
      </select>
    </div>

    <button type="submit" class="btn btn-primary">
                {{__('Post')}}
    </button>
</form>

</div>
</section>

@endsection
