@extends("layouts.login")

@section("content")

<div class = "post-form follow-image">
  Follow List
  <!-- ここを投稿の変数と揃えてしまうと投稿していない人が表示されない -->
  @foreach ($images as $image)
  <a href = "/user/{{$image->id}}/profile">
    <img class = "follow-icon" src = "{{ \Storage::url($image->images) }}" width = "35" height = "35" style = "border-radius: 50%;">
  </a>
  @endforeach
</div>
<!-- フォローしているユーザーのみ表示させたい -->
@foreach ($posts as $post)
<div class = "list">
  <div class = "left-list">
    <a href = "/user/{{$post->user_id}}/profile">
      <img src = "{{ \Storage::url($post->user->images) }}" width = "35" height = "35" style = "border-radius: 50%;">
    </a>
    <div class = "post-message">
      <div class = "under-margin">{{ $post->user->username }}</div>
      {!!nl2br ($post->post) !!}
    </div>
  </div>
  <div class = "right-list">
    {{ $post->updated_at }}
  </div>
</div>
@endforeach
@endsection
