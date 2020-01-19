@extends('layouts.app')

@section('content')
@if (session('flash_message'))
<div class="alert alert-primary text-center" id="dat" role="alert">
  {{ session('flash_message') }}
</div>
@endif

<div id="categoryapp" class="category__bg">
  <Category-component
    :morning = "{{$posts_morning}}"
    :daytime = "{{$posts_daytime}}"
    :night = "{{$posts_night}}"

  >
  </Category-component>
</div>

@endsection
