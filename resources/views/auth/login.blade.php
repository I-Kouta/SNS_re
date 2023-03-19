<!-- ログイン画面 -->
@extends('layouts.logout')

@section('content')

{!! Form::open(['class' => 'gray-back']) !!}

<p>AtlasSNSへようこそ</p>

{{ Form::label('address', 'mail address', ['class' => 'address']) }}<br /> <!-- 'for', '表記される' -->
{{ Form::text('mail',null,['class' => 'input']) }}<br />

{{ Form::label('password', 'password', ['class' => 'pass']) }}<br />
{{ Form::password('password',['class' => 'input']) }}<br />

{{ Form::submit('LOGIN',['class' => 'red-btn']) }}

<p><a href="/register">新規ユーザーの方はこちら</a></p>

{!! Form::close() !!}

@endsection
