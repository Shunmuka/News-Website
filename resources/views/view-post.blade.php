@extends('layout')

@section('title', 'View Post')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-body">
            <h1 class="card-title">{{ $article->title }}</h1>
            <p class="card-subtitle mb-4 text-muted">by {{ $article->user->name }}</p>
            <div class="row">
                <div class="col-md-8">
                    <p class="card-text">{{ $article->body }}</p>
                </div>
                <div class="col-md-4">
                    <img src="/storage/{{ $article->image }}" class="img-fluid rounded" alt="Article Image">
                </div>
            </div>
        </div>
        <div class="card-footer text-muted">
            <small>Published on {{ $article->created_at->format('F j, Y') }}</small>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card-title {
        font-size: 2rem;
        font-weight: bold;
  }

    .card-subtitle {
        font-size: 1.25rem;
    }

    .card-text {
        font-size: 1rem;
        color: #333;
    }

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .card-footer {
        background: #f8f9fa;
        border-top: 1px solid #e9ecef;
        text-align: right;
    }
</style>
@endsection
