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

    public function createArticle (Request $request) {
        $request->validate([
            'news_title' => 'required',
            'news_body' => 'required', 
            'news_image' => ['required', 'image', 'mimes: jpeg, png, jpg, gif, svg', 'max: 2048']
        ]);

        if($request->hasFile('news_image')) {
            $imageName = time().'.'.$request->news_image->extension();
            $request->news_image->storeAs('images', $imageName, 'public');

            $article = new Article([
                'title' =>$request->news_title,
                'body' => $request->news_body,
                'image' => $imageName,
                'user_id' => Auth::id()
            ]); 
            Article::create($article);
        }

        return redirect('/createPost')->with('success', 'Article created successfully!');

    }
}
