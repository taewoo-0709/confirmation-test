@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/confirm.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="confirm__content">
  <div class="confirm__heading">
    <h2>Confirm</h2>
  </div>
  <div class="confirm-table">
    <table class="confirm-table__inner">
      <tr class="confirm-table__row">
        <th class="confirm-table__header">お名前</th>
          <td class="confirm-table__text">
            <input type="text" name="name" value="{{ $contact['last_name'] }}   {{ $contact['first_name'] }}" readonly />
          </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">性別</th>
          <td class="confirm-table__text">
            @php
              $genderLabel = ['1' => '男性', '2' => '女性', '3' => 'その他'];
            @endphp
            <input type="text" name="gender" value="{{ $genderLabel[$contact['gender']] ?? '' }}" readonly />
            <input type="hidden" name="gender" value="{{ $contact['gender'] }}" />
          </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">メールアドレス</th>
          <td class="confirm-table__text">
            <input type="email" name="email" value="{{ $contact['email'] }}" readonly />
          </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">電話番号</th>
          <td class="confirm-table__text">
            <input type="tel" name="tel" value="{{ $contact['tel'] }}" readonly />
          </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">住所</th>
          <td class="confirm-table__text">
            <input type="text" name="address" value="{{ $contact['address'] }}" readonly />
          </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">建物名</th>
          <td class="confirm-table__text">
            <input type="text" name="building" value="{{ $contact['building'] }}" readonly />
          </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">お問い合わせの種類</th>
          <td class="confirm-table__text">
            <input type="text" name="category_id" value="{{ $category_content }}" readonly />
          </td>
      </tr>
      <tr class="confirm-table__row">
        <th class="confirm-table__header">お問い合わせ内容</th>
          <td class="confirm-table__text">
            <input type="text" name="detail" value="{{ $contact['detail'] }}" readonly />
          </td>
      </tr>
    </table>
  </div>
  <div class="form__button">
    <form class="form__submit--thanks" action="{{ url('/thanks') }}" method="post">
      @csrf
      @foreach($contact as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
      @endforeach
      <button class="form__button-submit" type="submit">送信</button>
    </form>
    <form class="form__button--fixes" action="{{ route('form.edit') }}" method="post">
      @csrf
      @foreach($contact as $key => $value)
        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
      @endforeach
      <button class="form__button-back" type="submit">修正</button>
    </form>
  </div>
</div>
@endsection