@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'post/create','class' => 'post-form']) !!}
<img class="form-icon" src="{{ \Storage::url(Auth::user()->images) }}" width="35" height="35" style="border-radius: 50%;">
{!! Form::textarea('newPost', null, ['required', 'class' => 'tweet', 'placeholder' => '投稿内容を入力してください', 'maxlength' => '200']) !!}
<button type="submit"><img src="{{ asset('images/post.png') }}" width="100" height="100"></button>
{!! Form::close() !!}

@foreach ($posts as $post)
<div class="list">
  <div class="left-list">
    <img src="{{ \Storage::url($post->user->images) }}" width="35" height="35" style="border-radius: 50%;">
    <div class="post-message">
      <div class="under-margin">{{ $post->user->username }}</div>
      <div>{!!nl2br ($post->post) !!}</div>
    </div>
  </div>
  <div class="right-list">
    <div>{{ $post->updated_at }}</div>
    @if(Auth::id() == $post->user->id)
    <div class="update-edit">
      <a class="js-modal-open" href="" post="{{ $post->post }}" post_id="{{ $post->id }}">
        <img src="{{ asset('images/edit.png') }}" width="30" height="30">
      </a>
      <a id="wrap" href="/post/{{$post->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
        <img class="img-before" src="{{ asset('images/trash.png') }}">
        <img class="img-after" src="{{ asset('images/trash-h.png') }}">
      </a>
    </div>
    @endif
  </div>
</div>
<!-- 編集内容が表示される -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    {!! Form::open(['url' => '/post/update']) !!}
    {!! Form::hidden('id', $post->id) !!}
    {!! Form::input('text', 'upPost', $post->post, ['required', 'class' => 'modal_post']) !!}
    <button type="submit"><img class="edit-btn" src="{{ asset('images/edit.png') }}" width="30" height="30"></button>
    {{ csrf_field() }}
    {!! Form::close() !!}
  </div>
</div>
@endforeach
@endsection
