<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function showManageCategories () {
        return view('manage_categories');
    }

    public function store (Request $request) {
        $data = $request->validate([
            'category_name' => 'required|unique:categories|max:50|min:5',
        ]);
    }
}
