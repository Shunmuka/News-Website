@extends('layout')
@section('title', 'Login')
@section('content')
@auth
<form class="ms-auto me-auto mt-auto" style="width: 500px" action="/create-article" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="mb-3">
    <label for="exampleName1" class="form-label">News Tite</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" name = "news_title">
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">News Body</label>
        <textarea class="form-control" aria-describedby="nameHelp" name = "news_body"></textarea>
    </div>
    <div class="mb-3">
        <label for="exampleNumber1" class="form-label">News Image</label>
        <input type="file" class="form-control" aria-describedby="addressHelp" name="news_image" accept="image/*">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <form action="/logout" method="POST" class="mt-auto mb-3">
        @csrf
        <button type="submit" class="btn btn-primary d-block mx-auto">Logout</button>
    </form>
</div>
@endauth
@endsection