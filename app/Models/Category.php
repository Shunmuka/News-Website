<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $unguarded = [];

    public function category() {
        return $this->belongsTo(Article::class, 'category_id');
    }
}
