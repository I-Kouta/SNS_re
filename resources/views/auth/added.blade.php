<!-- 登録完了画面 -->
@extends('layouts.logout')

@section('content')

<div class="gray-back">
  <p>{{ session('username') }}さん</p>
  <p>ようこそ！AtlasSNSへ！</p>
  <p>ユーザー登録が完了しました。</p>
  <p>早速ログインをしてみましょう。</p>

  <p class="btn red-btn"><a href="/login">ログイン画面へ</a></p>
</div>

@endsection
