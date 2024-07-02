@extends('layout')

@section('title', 'News Listings')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">News Listings</h1>
    <div class="row">
        @foreach($articles as $article)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }} by {{$article->user->name}}</h5>
                    <p class="card-text">{{ substr($article->body, 0, 50). '...' }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="/edit-post/{{$article->id}}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="/view-post/{{$article->id}}" class="btn btn-secondary btn-sm">View</a>
                    <form action="/delete-post/{{$article->id}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border-radius: 10px;
        overflow: hidden;
        transition: transform 0.2s;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .card-title {
        font-weight: bold;
    }

    .card-text {
        color: #555;
    }

    .card-footer {
        background: #f8f9fa;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-danger {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>
@endsection
