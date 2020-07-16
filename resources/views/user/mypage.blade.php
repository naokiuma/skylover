@extends('layouts.app')


@section('content')
マイページ

<?php echo $user; ?>

@foreach ($posts as $post)

<?php echo $post->title; ?>

@endforeach

 
@endsection