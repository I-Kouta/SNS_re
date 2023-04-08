@extends('layouts.login')

@section('content')

{!! Form::open(['url' => 'post/create','class' => 'post-form']) !!}
<img class="form-icon" src="{{ \Storage::url(Auth::user()->images) }}" width="35" height="35">
{{ Form::input('text', 'newPost', null, ['required', 'class' => 'tweet', 'placeholder' => '投稿内容を入力してください', 'maxlength' => '200']) }}
<button type="submit"><img src="{{ asset('images/post.png') }}" width="100" height="100"></button>
{!! Form::close() !!}

@foreach ($list as $list)
@if (auth()->user()->isFollowing($list->user->id) or (Auth::id() == $list->user->id))<!-- フォローしている、または(or)自分である -->
<div class="list">
  <div class="left-list">
    <img src="{{ \Storage::url($list->user->images) }}" width="35" height="35">
    <div class="post-message">
      <div class="under-margin">{{ $list->user->username }}</div>
      <div>{{ $list->post }}</div>
    </div>
  </div>
  <div class="right-list">
    <div>{{ $list->updated_at }}</div>
    @if(Auth::id() == $list->user->id)
    <div class="update-edit">
      <a class="js-modal-open" href="" post="{{ $list->post }}" post_id="{{ $list->id }}">
        <img src="{{ asset('images/edit.png') }}" width="30" height="30">
      </a>
      <a id="wrap" href="/post/{{$list->id}}/delete" onclick="return confirm('この投稿を削除します。よろしいでしょうか？')">
        <img class="img-before" src="{{ asset('images/trash.png') }}">
        <img class="img-after" src="{{ asset('images/trash-h.png') }}">
      </a>
    </div>
    @endif
  </div>
</div>
@endif
<!-- 編集内容が表示される -->
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    {!! Form::open(['url' => '/post/update']) !!}
    {!! Form::hidden('id', $list->id, ['class' => 'modal_id']) !!}
    {!! Form::input('text', 'upPost', $list->post, ['required', 'class' => 'modal_post']) !!}
    <button type="submit"><img class="edit-btn" src="{{ asset('images/edit.png') }}" width="30" height="30"></button>
    {{ csrf_field() }}
    {!! Form::close() !!}
  </div>
</div>
<!-- 編集内容が表示される -->
@endforeach

@endsection
