<!-- 新規ユーザー登録画面 -->
@extends('layouts.logout')

@section('content')

{!! Form::open(['class' => 'gray-back']) !!} <!-- HTMLのformの開始タグに相当 -->

<h2>新規ユーザー登録</h2>
@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach

{{ Form::label('user-name', 'user name', ['class' => 'name']) }}<br> <!-- 'for', '表記される' -->
{{ Form::text('username', null,['class' => 'input', 'placeholder' => 'admin']) }}<br>

{{ Form::label('address', 'mail address', ['class' => 'address']) }}<br>
{{ Form::text('mail', null, ['class' => 'input', 'placeholder' => 'admin@atlas.com']) }}<br>

{{ Form::label('password', 'password', ['class' => 'pass']) }}<br>
{{ Form::password('password', ['class' => 'input']) }}<br>

{{ Form::label('password_confirmation', 'password_confirm', ['class' => 'pass']) }}<br>
{{ Form::password('password_confirmation', ['class' => 'input']) }}<br>

{{ Form::submit('REGISTER', ['class' => 'red-btn']) }}

<p><a href="/login">ログイン画面へ戻る</a></p>

{!! Form::close() !!}


@endsection
