<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
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

    public function showNewsListings() {
        $articles = Article::where('is_deleted', 'N')->paginate(5);
        return view('news_listings', compact('articles'));
    }
    

    public function createArticle(Request $request) {
        $data = $request->validate([
            'news_title' => 'required',
            'news_body' => 'required', 
            'news_image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);
    
        $imagePath = $request->file('news_image')->store('images', 'public');
    
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();
    
        auth()->user()->posts()->create([
            'title' => $data['news_title'],
            'body' => $data['news_body'],
            'image' => $imagePath
        ]);
    
        return redirect('/createPost')->with('success', 'Article created successfully!');
    }
    
    public function showEditScreen(Article $article) {
        return view('edit-post', ['article' => $article]);
    }
    
    public function showArticle(Article $article) {
        return view('view-post', ['article' => $article]);
    }
}
