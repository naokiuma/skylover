<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>Sky Light Lover</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script><!--imagesLoaded-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
    <!--Iconfonts-->
    <link href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

</head>

<body>
  <div class="all-wrapper">
  <div id="app" class="contents-wrapper">
  <div class="sp-menu-box sp-menu-js"><i class="fab fa-mixcloud icon-mixcoud"></i></div>
  <div class="header-space"></div> 

  <div class="header-container">
    <div class="header-left">
    <a class="" href="{{ url('/') }}">
      Sky Light Lover
    </a>
    </div>
 
    <div class="header-right" id="navbarSupportedContent">
      <!-- Right Side Of Navbar -->
      <ul class="header-right-ul">
          <!-- Authentication Links -->
          @guest
              <li>
                  <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              <li>
                  <a class="" href="{{ route('posts.gallery') }}">{{ __('Gallery') }}</a>
              </li>
              <li>
                <a class="" href="{{ route('posts.category') }}">{{ __('Time') }}</a>
              </li>
          @if (Route::has('register'))
              <li>
                  <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
          @if(session('flash_message'))
              <div class="alert">
                {{session('flash_message')}}
              </div>
          @endif
          @else
            <li>
              <a class="" href="{{ route('posts.gallery') }}">{{ __('Gallery') }}</a>
            </li>
            <li>
              <a class="" href="{{ route('new') }}">{{ __('Post') }}</a>
            </li>
            <li>
              @if($user->name)
              <a href="">{{ $user -> name }}</a>
              @elseif($user ->handle)
              <a href="">{{ $user -> handle }}</a>
              @endif

            </li>
            <li>
              <a class="" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();"
              >{{ __('Logout') }}</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
            </li>
          @endguest
      </ul>
    </div>
    @auth 
    <div class="widget-wrapper">
      <div>Favorite</div>
    </div>
    @endauth
  </div>
  <div class="favs-window">
    <div class="favs-posts-wrapper">


    </div>
  </div>

    @yield('content')

<!--
<footer class="footer">
Copyright © Sky Light Lover. All rights reserved
</footer>
-->

</div>
</div>


<?php 
//アプリのurlを持ってくる。
$site_url = (config('app.url')); 
?>


<script>


//スクロールするとひっこめる動き。pcの場合のみ
if (window.matchMedia('(min-width: 414px)').matches) {
  // PC表示の時の処理
let startPos = 0,winScrollTop = 0;
$(window).on('scroll',function(){
    winScrollTop = $(this).scrollTop();
    if (winScrollTop >= startPos &&  winScrollTop >= 200) {
        $('.header-container').addClass('hide');
    } else {
        $('.header-container').removeClass('hide');
    }
    startPos = winScrollTop;
});
} 
</script>

<script>
//スマホメニューonoff。スマホの場合のみ
//sp-activeclassの有無でスマホメニューを開いているか判定
if (window.matchMedia('(max-width: 414px)').matches) {

$(function(){
  $(".sp-menu-js").click(function(){
    if ($('.header-container').hasClass("sp-active")) {
    // 表示されている場合の処理
    $(".header-container").css("transform","translateX(-100%)");
    $(".header-container").removeClass("sp-active");
    } else {
    // 非表示の場合の処理
    $(".header-container").css("transform","translateX(0%)");
    $(".header-container").addClass("sp-active");
    } 
  })
})
}

</script>

<script>
/*
  $.ajaxSetup({
    beforeSend : function(xhr) {
        xhr.overrideMimeType('text/html;charset=Shift_JIS');
    }
});
*/
var fav_flg = false;
var site_url = @json($site_url);


$(document).on('click', '.widget-wrapper', function(e){
  if(fav_flg === false){
      let userid = @json($user)['id'];
      //console.log(userid);
      console.log(site_url);
      //var search_favurl = `/favs/${userid}/`//デフォ
      var search_favurl = `${site_url}/favs/${userid}`//サイトurlも含んだもの
      e.preventDefault();
      $.ajax({
        type: "get",
        url:search_favurl,
        dataType:'json',
      }).done(function ( result ){
        console.log('Ajax Success');
        console.log(result);
        fav_flg = true;
        console.log("flgはtrueです");
        $(".favs-window").toggle(500);
          $.each(result, function(i, val) {
            var temp_dom = $( `
            <div class="favs-post">
              <a href="posts/${i}"><img src="../${val}" alt=""></a>
            </div>
            `, 
            );
            $(".favs-posts-wrapper").append(temp_dom);
            temp_dom = null;
          });
          
      }).fail(function( msg ){
        console.log('Ajax Error');
        console.log(msg);
    });

  }else{
    fav_flg = false;
    console.log("flgはfalseです");
    $(".favs-posts-wrapper").empty();
    $(".favs-window").toggle(500);


  }

});


</script>


</body>
</html>
