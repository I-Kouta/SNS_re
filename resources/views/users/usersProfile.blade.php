@extends('layouts.login')

@section('content')
@foreach ($user as $user)
<div class="post-form">
  <img src="{{ \Storage::url($user->images) }}" width="35" height="35">
  <div class="post-message prof-head">
    <div class="prof-head-title">
      <div class="under-margin">name</div>
      bio
    </div>
    <div>
      <div class="under-margin">{{ $user->username }}</div>
      {{ $user->bio }}
    </div>
    @if (auth()->user()->isFollowed($user->id))
    <p style="font-size:15px; margin-left: 20px; color: #186AC9;">フォローされています</p>
    @endif
  </div>
  @if (auth()->user()->isFollowing($user->id))
  <p class="unFollow-btn" onclick="location.href='/{{$user->id}}/unFollow'"><a>フォロー解除</a></p>
  @else
  <p class="follow-btn" onclick="location.href='/{{$user->id}}/follow'"><a>フォローする</a></p>
  @endif
</div>
@endforeach

@foreach ($posts as $posts)
<div class="list">
  <div class="left-list">
    <img src="{{ \Storage::url($posts->user->images) }}" width="35" height="35">
    <div class="post-message">
      <div class="under-margin">{{ $posts->user->username }}</div>
      {{ $posts->post }}
    </div>
  </div>
  <div class="right-list">
    {{ $posts->updated_at }}
  </div>
</div>
@endforeach

@endsection
