@extends('layouts.app')


@section('content')

<h2 class="mypage-read">マイページ</h2>

<section class="mypage">
    <div class="user__wrapper">
        <div class="user_name">
            @if($user->name)
                <p>{{ $user -> name }}</p>
            @elseif($user->handle)
                <p>{{ $user->handle }}</p>
            @else
                <p>名無しさん</p>
            @endif
        </div>
        @if($user->avatar)
            <div class="user_image">
                <img src="{{ $user -> avatar }}" alt="">
            </div>
        @endif

    </div>

    <div class="posts__wrapper">
        @foreach ($posts as $post)
        <?php echo $post; ?>
        @endforeach
    </div>



</section>


以下はテスト。
ユーザー情報。
<?php echo $user; ?>

ポスト情報。
@foreach ($posts as $post)

<?php echo $post; ?>

@endforeach

 
@endsection