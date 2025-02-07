@extends('layouts.login')

@section('content')

<img class="user-image profile-icon" src="{{ \Storage::url(Auth::user()->images) }}" width="35" height="35" style="border-radius: 50%;">
@foreach ($errors->all() as $error)
  <li>{{$error}}</li>
@endforeach

{!! Form::open(['url' => '/profile/update', 'files' => true, 'class' => 'profile-top']) !!}
{!! Form::hidden('id', Auth::user()->id) !!}
<div class="category">
  {{ Form::label('user-name', 'user name', ['class' => 'name']) }}
  {{ Form::input('username', 'username', Auth::user()->username, ['class' => 'output']) }}
</div>

<div class="category">
  {{ Form::label('address', 'mail address', ['class' => 'address']) }}
  {{ Form::input('mail', 'mail', Auth::user()->mail, ['class' => 'output']) }}
</div>

<div class="category">
  {{ Form::label('password', 'password', ['class' => 'pass']) }}
  {{ Form::password('password', ['class' => 'output']) }}
</div>

<div class="category">
  {{ Form::label('password_confirmation', 'password confirm', ['class' => 'pass']) }}
  {{ Form::password('password_confirmation',['class' => 'output']) }}
</div>

<div class="category">
  {{ Form::label('bio', 'bio', ['class' => 'bio']) }}
  {{ Form::input('bio', 'bio', Auth::user()->bio,['class' => 'output']) }}
</div>

<div class="category">
  {{ Form::label('icon-image', 'icon image', ['class' => 'icon-image']) }}
  {{ Form::file('image', ['class' => 'output file']) }}
</div>
{{ Form::submit('更新',['class' => 'red-btn']) }}
{!! Form::close() !!}

@endsection
