@extends('layouts.login')

@section('content')

<div class="post-form follow-image">
  Follower List
  <!-- ここを投稿の変数と揃えてしまうと投稿していない人が表示されない -->
  @foreach ($image as $image)
  <a href="/user/{{$image->id}}/profile">
    <img class="follow-icon" src="{{ \Storage::url($image->images) }}" width="35" height="35" style="border-radius: 50%;">
  </a>
  @endforeach
</div>

@foreach ($lists as $list)
<div class="list">
  <div class="left-list">
    <a href="/user/{{$list->user_id}}/profile">
      <img src="{{ \Storage::url($list->user->images) }}" width="35" height="35" style="border-radius: 50%;">
    </a>
    <div class="post-message">
      <div class="under-margin">{{ $list->user->username }}</div>
      {{ $list->post }}
    </div>
  </div>
  <div class="right-list">
    {{ $list->updated_at }}
  </div>
</div>
@endforeach

@endsection
