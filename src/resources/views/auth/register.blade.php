@extends('layouts.app')
@section('body_class', 'register-page')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/login.css') }}?v={{ time() }}">
  <link rel="stylesheet" href="{{ asset('css/register.css') }}?v={{ time() }}">
@endsection

@section('nav')
  <nav>
    <ul>
      <li class="header-nav">
        <a class="header-nav__link" href="{{ route('login') }}">login</a>
      </li>
    </ul>
  </nav>
@endsection

@section('content')
<div class="login-page">
  <div class="login-form__content">
    <div class="login-form__header">
      <h2>Register</h2>
    </div>
    <form class="form" action="{{ route('register') }}" method="post">
      @csrf
      <div class="form__group">
        <div class="form__group-title">
          <span class="form__label--item">お名前</span>
        </div>
        <div class="form__group-content">
          <div class="form__input--text">
            <input class="input-name" type="text" name="name" placeholder="例:山田  太郎" value="{{ old('name') }}"/>
          </div>
          <div class="form__error">
            @error('name')
              {{$message}}
            @enderror
          </div>
        </div>
      </div>
      <div class="form__group">
        <div class="form__group-title">
          <span class="form__label--item">メールアドレス</span>
        </div>
        <div class="form__group-content">
          <div class="form__input--text">
            <input class="input-email" type="email" name="email" placeholder="例:test@example.com" value="{{ old('email') }}"/>
          </div>
          <div class="form__error">
            @error('email')
              {{$message}}
            @enderror
          </div>
        </div>
      </div>
      <div class="form__group">
        <div class="form__group-title">
          <span class="form__label--item">パスワード</span>
        </div>
        <div class="form__group-content">
          <div class="form__input--text">
            <input class="input-password" type="password" name="password" placeholder="例:coachtech1106" />
          </div>
          <div class="form__error">
            @error('password')
              {{$message}}
            @enderror
          </div>
        </div>
      </div>
      <div class="form__button">
        <button class="form__button-submit" type="submit">登録</button>
      </div>
    </form>
  </div>
</div>
@endsection