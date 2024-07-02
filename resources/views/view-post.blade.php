@extends('layout')

@section('title', 'View Post')

@section('content')
<div class="container">
  <h1>{{ $article->title }}</h1>
  <p style="font-weight: bold">by {{$article->user->name}}</p>
    <div class="mb-3">
      {{ $article->body }}
</div>
@endsection
