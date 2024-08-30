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
                        <p class="card-text">{{ \Illuminate\Support\Str::words($article->body, 50, '...') }}</p>
                        <p class="card-text"><small class="text-muted">Category: {{ $article->category->category_name }}</small></p>
                    </div>
                    <div>
                      <a href="{{ route('view-post', $article->id) }}" class="btn btn-link p-0">Read More</a>
                    </div>    
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
