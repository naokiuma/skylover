@extends('layouts.app')

@section('content')

<h1 class="form-top">{{ __('Register') }}</h1>

<section class="form__wrapper">
<div class="form__container">
    <h2>Eメールで登録する</h2>
    <div class="form__area">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                        <div>
                            <label for="name" >{{ __('Name') }}</label>
                            <div>
                                <input id="name" type="text"  name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

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

                        <div>
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
                            <label for="password" >{{ __('Confirm Password') }}</label>

                            <div>
                            <input id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password">

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


    <div class="form-tw__container">
        <h2>ツイッターアカウントで登録/ログインする</h2>
        <a href="auth/twitter"><button>Twitter</button></a>
        <p>ツイッターアカウントがあれば、本サービスでのEメール登録は不要です。</p>
    </div>
</section>

@endsection
