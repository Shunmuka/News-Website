@extends('layout')

@section('title', 'News Listings')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">News Listings</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        @foreach($articles as $article)
        <div class="col-12 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/storage/{{ $article->image }}" class="img-fluid rounded-start" alt="Article Image" style="height: 200px; width: 300px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="card-title">{{ $article->title }} by {{ $article->user->name }}</h5>
                                <p class="card-text">{{ substr($article->body, 0, 50) . '...' }}</p>
                                <p class="card-text"><small class="text-muted">Category: {{ $article->category->category_name }}</small></p>
                            </div>
                            @if (auth()->check() && auth()->user()->id === $article->user_id)
                                <div class="d-flex justify-content-between mt-3">
                                    <a href="/edit-post/{{ $article->id }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="/view-post/{{ $article->id }}" class="btn btn-secondary btn-sm">View</a>
                                    <form action="/delete-post/{{ $article->id }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            @endif                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{ $articles->onEachSide(1)->links('pagination::bootstrap-4') }}
        </div>
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

    .img-fluid {
        max-width: 100%;
        height: auto;
        border-radius: 10px 0 0 10px;
    }

    .card-body {
        padding: 1.25rem;
    }

    .pagination .page-link {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }

    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        font-size: 1rem;
    }
</style>
@endsection