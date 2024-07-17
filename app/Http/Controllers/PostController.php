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

    public function deletePost(Article $article)
    {
        if (auth()->user()->id === $article->user_id) {
            $article->update(['is_deleted' => 'Y']);
        }

        return redirect('/newsListings')->with('success', 'Post deleted successfully!');
    }



    public function updatePost(Article $article, Request $request)
    {
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);
    
        if (auth()->user()->id !== $article->user_id) {
            return redirect('/newsListings')->withErrors(['msg' => 'Unauthorized action.']);
        }
    
        if ($request->hasFile('image')) {
            if ($article->image) {
                \Storage::delete('public/' . $article->image);
            }
    
            $imagePath = $request->file('image')->store('images', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
            $image->save();
    
            $incomingFields['image'] = $imagePath;
        }
    
        $article->update([
            'title' => $incomingFields['title'],
            'body' => $incomingFields['body'],
            'image' => $incomingFields['image'] ?? $article->image,
        ]);
    
        return redirect()->back()->with('success', 'Post updated successfully!');
    }
    
    
    

    public function showNewsListings()
    {
        $articles = Article::where('is_deleted', 'N')->orderBy('created_at', 'desc')->paginate(5);
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
    
        return redirect('/createPost')->with('success', 'Post created successfully!');
    }
    
    
    public function showEditScreen(Article $article) {
        return view('edit-post', ['article' => $article]);
    }
    
    public function showArticle(Article $article) {
        return view('view-post', ['article' => $article]);
    }
}
