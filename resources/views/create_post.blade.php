@extends('layout')

@section('title', 'Create Post')

@section('content')
@auth
<div class="container mt-5">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="ms-auto me-auto mt-auto needs-validation" style="width: 500px" action="/create-article" enctype="multipart/form-data" method="POST" novalidate>
        @csrf
        <div class="mb-3">
            <label for="newsTitle" class="form-label">News Title</label>
            <input type="text" class="form-control @error('news_title') is-invalid @enderror" id="newsTitle" name="news_title" required>
            <div class="invalid-feedback">
                Please enter a news title.
            </div>
        </div>
        <div class="mb-3">
            <label for="newsBody" class="form-label">News Body</label>
            <textarea class="form-control @error('news_body') is-invalid @enderror" id="newsBody" name="news_body" required></textarea>
            <div class="invalid-feedback">
                Please enter the news body.
            </div>
        </div>
        <div class="mb-3">
            <label for="newsCategory" class="form-label">Category</label>
            <select class="form-select @error('category_id') is-invalid @enderror" id="newsCategory" name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please select a category.
            </div>
        </div>
        <div class="mb-3">
            <label for="newsImage" class="form-label">News Image</label>
            <input type="file" class="form-control @error('news_image') is-invalid @enderror" id="newsImage" name="news_image" accept="image/*" required>
            <div class="invalid-feedback">
                Please upload an image.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endauth
@endsection

@push('scripts')
<script>
    (function () {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush