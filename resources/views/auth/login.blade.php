@extends('layouts.app')

@section('content')

<h1 class="form-top">{{ __('Login') }}</h1>

<section class="form__wrapper">
<div class="form__container">
    <h2>Eメールでログインする</h2>
        <div class="form__area">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label for="email">{{ __('E-Mail Address') }}</label>
                     <div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class>
                    <label for="password" >{{ __('Password') }}</label>

                    <div>
                        <input id="password" type="password"  name="password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div>
                    <div>
                        <div>
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div>
                    <div>
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                パスワードを忘れましたか？
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
</div>

<div class="form-tw__container">
    <h2>ツイッターでログインする</h2>
    <a href="auth/twitter"><button>Twitter</button></a>
    <p>ツイッターアカウントがあれば、<br>本サービスでのEメール登録は不要です。</p>
</div>

</section>

@endsection
