@extends('layout')

@section('title', 'Edit Post')

@section('content')
<div class="container">
  <h1>Edit Post</h1>
  <form action="/edit-post/{{$article->id}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" name="title" class="form-control" id="title" value="{{ $article->title }}">
    </div>
    <div class="mb-3">
      <label for="body" class="form-label">Body</label>
      <textarea name="body" class="form-control" id="body">{{ $article->body }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save Changes</button>
  </form>
</div>
@endsection
