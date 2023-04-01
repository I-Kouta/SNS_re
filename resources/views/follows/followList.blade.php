@extends('layouts.login')

@section('content')

<div class="post-form follow-image">
  Follow List
  @foreach ($image as $image)
  <a href="/user/{{$image->id}}/profile">
    <img class="follow-icon" src="{{ \Storage::url($image->images) }}" width="35" height="35">
  </a>
  @endforeach
</div>
<!-- フォローしているユーザーのみ表示させたい -->
@foreach ($lists as $list)
<div class="list">
  <div class="left-list">
    <a href="/user/{{$list->user_id}}/profile">
      <img src="{{ \Storage::url($list->user->images) }}" width="35" height="35">
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
