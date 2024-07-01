@extends('layout')

@section('title', 'News Listings')

@section('content')
<div class="container">
    <h1>News Listings</h1>
    <div class="row">
        @foreach($articles as $article)
        <div class="col-md-4 mb-4">
            <div class="card">
              <table>
                <tr>   
                  <th><h5 class="card-title">{{ $article->title }} by {{$article->user->name}}</h5></th>
                </tr>
                <td>
                  <p class="card-text">{{ substr($article->body, 0, 50). '...' }}</p>
                </td>
                <td>
                <p><a href="/edit-post/{{$article->id}}">Edit</a></p>
                </td>
                <td><form action="/delete-post/{{$article->id}}" method="POST">
                @csrf
                @method('DELETE')
                <button>Delete</button>
                </form>
              </td>
              </table>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
