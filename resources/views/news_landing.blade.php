
@extends('layout')

@section('title', 'News Landing')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">News Landing</h1>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-8" id="articles-container">
            @include('partials.articles', ['articles' => $articles])
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    {{ $articles->onEachSide(1)->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mb-4">
                <h4>Categories</h4>
                <ul class="list-group">
                    @forelse($categories as $category)
                        <li class="list-group-item">
                            <a href="#" class="category-link" data-id="{{ $category->id }}">{{ $category->category_name }}</a>
                        </li>
                    @empty
                        <li class="list-group-item">No categories available.</li>
                    @endforelse
                </ul>
            </div>

            <div class="mt-5">
                <h4>Popular Articles</h4>
                <ul class="list-group">
                    @forelse($popularArticles as $article)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="{{ route('view-post', $article->id) }}">{{ $article->title }}</a>
                            <span class="badge bg-info popular-article-{{ $article->id }}-views">
                               {{ $article->views_count }} views
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item">No popular articles available.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Handle category clicks
    $(document).on('click', '.category-link', function(e) {
        e.preventDefault();
        var categoryId = $(this).data('id');
        
        // Add active class to selected category
        $('.category-link').removeClass('active');
        $(this).addClass('active');
        
        $.ajax({
            url: `/posts-by-category/${categoryId}`,
            method: 'GET',
            success: function(response) {
                $('#articles-container').html(response.html);
            },
            error: function(error) {
                console.error('Error fetching category posts:', error);
            }
        });
    });

    // Handle pagination clicks for category filtered results
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var categoryId = $('.category-link.active').data('id');
        
        if (categoryId) {
            loadPosts(page, categoryId);
        }
    });

    function loadPosts(page, categoryId) {
        $.ajax({
            url: `/posts-by-category/${categoryId}?page=${page}`,
            success: function(response) {
                $('#articles-container').html(response.html);
            }
        });
    }
});
</script>
@endpush