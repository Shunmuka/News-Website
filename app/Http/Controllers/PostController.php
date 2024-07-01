<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function showCreatePage () {
        return view('create_post');
    }

    public function deletePost(Article $article){
        if (auth()->user()->id === $article['user_id']) {
           $article->delete();
        }

        return redirect('/newsListings');
    }

    public function showNewsListings () {
        $articles = Article::all();
        return view('news_listings', ['articles'=> $articles]);
    }

    public function createArticle (Request $request) {
        $request->validate([
            'news_title' => 'required',
            'news_body' => 'required', 
            'news_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max: 2048']
        ]);

        if($request->hasFile('news_image')) {
            $imageName = time().'.'.$request->news_image->extension();
            $request->news_image->storeAs('images', $imageName, 'public');

            $article = [
                'title' =>$request->news_title,
                'body' => $request->news_body,
                'image' => $imageName,
                'user_id' => Auth::id()
            ];

            Article::create($article);
        }

        return redirect('/createPost')->with('success', 'Article created successfully!');

    }

    public function showEditScreen(Article $article) {
        if (auth()->user()->id !== $article['user_id']) {
            return redirect('/newsListings');
        }

        return view('edit-post', ['post' => $article]);
    }
}
