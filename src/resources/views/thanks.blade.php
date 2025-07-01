@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/thanks.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="thanks__content">
  <div class="thanks__heading">
    <h2>お問い合わせありがとうございました</h2>
  </div>
  <div class="thanks__button">
    <a href="/" class="thanks__button--home">HOME</a>
  </div>
</div>
@endsection