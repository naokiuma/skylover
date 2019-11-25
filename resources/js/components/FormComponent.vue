<template>

<form method="POST" action="{{ route('posts.create')}}" id="form">
  {{ csrf_field() }}

<!--タイトル-->
<label for="title">{{ __('Title') }}</label><br>
  <input type="text" name="title" value=""
  autocomplete="title" autofocus><br>
  <p class="error" v-if="error.title">{{ 'error.title' }}</p><br>
  @if ($errors->has('title'))
  <span class="" role="alert">
    <strong>{{ __('タイトルを再度入力してください。') }}</strong>
  </span>
  @endif

<br>

<!--コンテンツ-->
<label for="content">{{ __('Content') }}</label><br>
  <input type="textarea" name="content" value="" autocomplete="content" autofocus><br>
    <p class="error" v-if="error.content">{{ 'error.content' }}</p><br>
  @if ($errors->has('content'))
  <span class="" role="alert">
    <strong>{{ __('入力してください。') }}</strong>
  </span>
  @endif
<br>

<!--カテゴリネーム-->
<label for="category_name">{{__('Category')}}</label><br>
  <select class="" name="category_id">
    <option value="1" selected>明るい空</option>
    <option value="2">夕の空</option>
    <option value="3">雲</option>
  </select>

<br>

<button type="submit" class="btn btn-primary">
            {{__('Post')}}
</button>

</form>
</template>
