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
  <div id="app">
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
                    <a class="" href="{{ route('posts.category') }}">{{ __('Time') }}</a>
                </li>
                <li>
                  <a class="" href="{{ route('new') }}">{{ __('Post') }}</a>
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



  </div>
    @yield('content')
  </div>


<!--<footer class="footer"></footer>-->

<!--
<script>
  //これをやる場合はslid-slickをslideThumbnailにかえろ
  var loop = setInterval(function(){
    
    //js-eachpost専用要素のクローンを作成
    var clone = $(".js-eachpost:last").clone(true);
    $(".slideThumbnail").animate({
     "marginLeft":"25%"
    },700,"swing",function(){
      $(".js-eachpost:last").remove();
      $(".slideThumbnail").animate({
     "marginLeft":"0"
    },0)
      //クローンを最後に追加
      clone.clone(true).insertBefore($(".js-eachpost:first"));
    });


  },3000);
</script>
-->

<script>
  $(function(){
    console.log("1");
    let setElm = $('.loopSlider'),
    slideSpeed = 2000;
    console.log("1.5");
    console.log(setElm);

      setElm.each(function(){
        console.log("2");
        let self = $(this),
        selfWidth = self.innerWidth(),
        findUl = self.find('ul'),
        findPost = findUl.find('js-eachpost'),//一つ一つの要素の長さ
        postWidth = findPost.outerWidth(),
        postCount = findPost.length,
        loopWidth = postWidth * postCount;

        findUl.wrapAll('<div class="loopSliderWrap" />');
        let selfWrap = self.find('.loopSlideWrap');

        if(loopWidth > selfWidth){
          console.log("3");
            findUl.css({width:loopWidth}).clone().appendTo(selfWrap);
 
            selfWrap.css({width:loopWidth*2});
 
            function loopMove(){
                selfWrap.animate({left:'-' + (loopWidth) + 'px'},slideSpeed*listCount,'linear',function(){
                    selfWrap.css({left:'0'});
                    loopMove();
                });
            };
            loopMove();
        }

      });
  });



</script>


<script>
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
</script>



</body>
</html>
