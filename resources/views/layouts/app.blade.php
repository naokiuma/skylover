<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>Sky Light Lover</title>

    <!-- Scripts。ファイルとmasonaryとjquery -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js"></script><!--imagesLoadedってやつ-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c" rel="stylesheet">
      <!--Iconfonts-->
    <link href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

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
                          <li class="nav-item">
                            <a class="nav-link" href="{{ route('new') }}">{{ __('Post') }}</a>
                          </li>

                          <li>
                            <a class="dropdown-item" href="{{ route('logout') }}">{{__('Logout')}}</a>
                          </li>



                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

            @yield('content')
    </div>




<script>
/*fadeinロゴ*/
$(function() {
	setTimeout(function(){
		$('.start h2').fadeIn(1600);
    },500); //0.5秒後にロゴをフェードイン!
    setTimeout(function(){
        $('.start span').fadeIn(1600);
    },1000);
	setTimeout(function(){
		$('.start').fadeOut(500);
	},2000); //2.5秒後にロゴ含め真っ白背景をフェードアウト！
});
      

// init Masonry
var $each_posts = $('.each_posts').masonry({
  // options
    itemSelector: '.each_post',
    columnWidth: 10,
    gutter: 5,
    fitWidth: true
});
// layout Masonry after each image loads （imagesLoaded）
$each_posts.imagesLoaded().progress( function() {
  $each_posts.masonry('layout');
});
 


</script>
</body>
</html>
