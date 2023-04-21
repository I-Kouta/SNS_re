@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'search','class' => 'post-form']) !!}
<!-- ここはpostで送っている -->
{{ Form::input('text', 'keyword', null, ['required', 'class' => 'search', 'placeholder' => 'ユーザー名']) }}
<button type="submit"><img src="{{ asset('images/search.png') }}" width="60" height="60"></button>
@if(!empty($keyword))
<div class="search-word">
  検索ワード：{{ $keyword }}
</div>
@endif
{!! Form::close() !!}

<div class="search-form">
  @foreach ($user as $user)
  <div class="search-info">
    <img src="{{ \Storage::url($user->images) }}" width="35" height="35" style="border-radius: 50%;">
    {{ $user->username }}
    @if (auth()->user()->isFollowing($user->id))
    <p class="unFollow-btn" onclick="location.href='/{{$user->id}}/unFollow'"><a>フォロー解除</a></p>
    @else
    <p class="follow-btn" onclick="location.href='/{{$user->id}}/follow'"><a>フォローする</a></p>
    @endif
  </div>
  @endforeach
</div>

@endsection
