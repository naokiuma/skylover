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
        <nav class="navbar font-s navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Sky Light Lover
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('posts.gallery') }}">{{ __('Gallery') }}</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="{{ route('posts.category') }}">{{ __('Time') }}</a>
                            </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                        @if(session('flash_message'))
                            <div class="alert">
                              {{session('flash_message')}}
                            </div>
                            @endif
                        @else
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('posts.gallery') }}">{{ __('Gallery') }}</a>
                          </li>
                          <li class="nav-item">
                              <a class="nav-link" href="{{ route('posts.category') }}">{{ __('Time') }}</a>
                          </li>
                          <li class="nav-item post-button">
                            <a class="nav-link" href="{{ route('new') }}">{{ __('Post') }}</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
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
        </nav>

            @yield('content')
    </div>

<!--<footer class="footer"></footer>-->
<script>

</script>



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



</body>
</html>
