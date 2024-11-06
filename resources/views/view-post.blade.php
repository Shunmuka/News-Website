@extends('layout')

@section('title', $article->title)

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <img src="/storage/{{ $article->image }}" class="card-img-top" alt="Article Image">
                <div class="card-body">
                    <h1 class="card-title">{{ $article->title }}</h1>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">By {{ $article->user->name }}</span>
                        <span class="badge bg-info" id="view-counter">
                            <span id="views-count">{{ $article->views_count }}</span> views
                        </span>
                    </div>
                    <p class="card-text">{!! nl2br(e($article->body)) !!}</p>
                    <div class="mt-4">
                        <a href="{{ route('landing.index') }}" class="btn btn-primary">Back to News</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Only increment view if this is a new page view (not a refresh)
    if (!sessionStorage.getItem('viewed_{{ $article->id }}')) {
        incrementViewCount();
        sessionStorage.setItem('viewed_{{ $article->id }}', 'true');
    }

    function incrementViewCount() {
        fetch('{{ route('increment.views', $article->id) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json()
        })
        .then(data => {
            if (data.success) {
                document.getElementById('views-count').textContent = data.new_count;
                
                // Also update the count in the popular articles sidebar if it exists
                const sidebarArticleViews = document.querySelector('.popular-article-{{ $article->id }}-views');
                if (sidebarArticleViews) {
                    sidebarArticleViews.textContent = `${data.new_count} views`;
                }
            }
        })
        .catch(error => console.error('Error:', error));
    }
});
</script>
@endpush
@endsection