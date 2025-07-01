@extends('layouts.app')

@section('css')
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ time() }}">
@endsection

@section('nav')
  <nav>
    <ul>
      @if (Auth::check())
      <li class="header-nav">
        <form action="/logout" method="post">
      @csrf
      <button class="header-nav__link" type="submit">logout</button>
        </form>
      </li>
      @endif
    </ul>
  </nav>
@endsection

@section('content')
<div class="admin-form__page">
  <div class="admin-form__header">
    <h2>Admin</h2>
  </div>

<div class="admin-container">
  <div class="admin-form__content">
    <form class="admin-form" action="/admin" method="get">
    @csrf
      <div class="admin-form__row">
        <div class="admin-form__item">
          <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
        </div>
        <div class="admin-form__item">
          <select class="custom-select" name="gender">
            <option value="">性別</option>
            <option value="all" {{ request('gender') == 'all' ? 'selected' : '' }}>全て</option>
            <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
          </select>
        </div>
        <div class="admin-form__item">
          <select class="custom-select" name="category_id">
            <option value="">お問い合わせの種類</option>
            @foreach($categories as $category)
              <option value="{{ $category['id'] }}" {{ request('category_id') == $category['id'] ? 'selected' : '' }}>
                {{ $category['content'] }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="admin-form__item">
          <input type="date" name="date" value="{{ request('date') }}">
        </div>
        <div class="admin-form__item">
          <div class="admin-form__buttons">
            <button class="search-button" type="submit">検索</button>
            <a class="reset-button" href="/admin">リセット</a>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- エクスポート -->
<div class="admin-container">
  <div class="admin-functions">
    <form method="get" action="{{ route('admin.export') }}">
  <input type="hidden" name="keyword" value="{{ request('keyword') }}">
  <input type="hidden" name="category_id" value="{{ request('category_id') }}">
  <input type="hidden" name="gender" value="{{ request('gender') }}">
  <input type="hidden" name="date" value="{{ request('date') }}">
    <button class="export-button">エクスポート</button>
</form>
  <div class="pagination-wrapper">
      {{ $contacts->links('vendor.pagination.custom') }}
    </div>
  </div>
</div>
<!-- テーブル -->
<div class="admin-container">
  <div class="admin-table">
    <table class="admin-table__inner">
      <thead>
        <tr class="admin-table__row">
          <th class="admin-table__header">お名前</th>
          <th class="admin-table__header">性別</th>
          <th class="admin-table__header">メールアドレス</th>
          <th class="admin-table__header">お問い合わせの種類</th>
          <th class="admin-table__header"></th>
        </tr>
      </thead>
      <tbody>
        @if($contacts->isNotEmpty())
          @foreach ($contacts as $contact)
          <tr class="admin-table__row">
            <td class="admin-table__item">{{ $contact['last_name'] }} {{ $contact['first_name'] }}</td>
            <td class="admin-table__item">
              @if($contact['gender'] == 1)
                男性
              @elseif($contact['gender'] == 2)
                女性
              @elseif($contact['gender'] == 3)
                その他
              @endif
            </td>
            <td class="admin-table__item">{{ $contact['email'] }}</td>
            <td class="admin-table__item">{{ $contact->category->content }}</td>
            <td class="admin-table__item">
              <button class="detail-button" onclick="document.getElementById('modal-{{ $contact->id }}').style.display='block'">詳細</button>
<!-- モーダル -->
            <div id="modal-{{ $contact->id }}" class="modal-overlay" style="display: none;">
              <div class="modal-content">
                <button class="close-button" onclick="document.getElementById('modal-{{ $contact->id }}').style.display='none'">×</button>
                  <div class="modal-row">
                    <span class="modal-label">お名前</span>
                    <span class="modal-value">{{ $contact['last_name'] }} {{ $contact['first_name'] }}</span>
                  </div>
                  <div class="modal-row">
                    <span class="modal-label">性別</span>
                    <span class="modal-value">
                      @if($contact['gender'] == 1) 男性
                      @elseif($contact['gender'] == 2) 女性
                      @elseif($contact['gender'] == 3) その他
                      @endif
                    </span>
                  </div>
                  <div class="modal-row">
                    <span class="modal-label">メールアドレス</span>
                    <span class="modal-value">{{ $contact['email'] }}</span>
                  </div>
                  <div class="modal-row">
                    <span class="modal-label">電話番号</span>
                    <span class="modal-value">{{ $contact['tel'] }}</span>
                  </div>
                <div class="modal-row">
                  <span class="modal-label">住所</span>
                  <span class="modal-value">{{ $contact['address'] }}</span>
                </div>
                <div class="modal-row">
                  <span class="modal-label">建物名</span>
                  <span class="modal-value">{{ $contact['building'] }}</span>
                </div>
                <div class="modal-row">
                  <span class="modal-label">お問い合わせの種類</span>
                  <span class="modal-value">{{ $contact->category->content ?? '未設定' }}</span>
                </div>
                <div class="modal-row">
                  <span class="modal-label">お問い合わせ内容</span>
                  <span class="modal-value">{{ $contact['detail'] }}</span>
                  </div>
                  <div class="modal-row">
                  <form class="delete-data" action="/contacts/delete" method="post">
                    @method ('DELETE')
                    @csrf
                    <div class="delete-data__form">
                      <input type="hidden" name="id" value="{{ $contact['id'] }}">
                      <button class="data-delete__button">削除</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            </td>
          </tr>
          @endforeach
        @endif
      </tbody>
@endsection