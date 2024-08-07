<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index(Request $request) {
        $categories = Category::all();
        if($request->ajax()){ 
            return datatables()->of($categories)
            ->addColumn('action', function() {
                return '<a href class="btn btn-info"></a>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function create () {
        return view('manage_categories');
    }

    public function store (Request $request) {
        $data = $request->validate([
            'category_name' => 'required|unique:categories|max:50|min:2',
        ]);

        Category::create([
            'category_name' => $request->category_name
        ]);

        return response()->json([
            'success' => 'Category Saved',
        ], 201);
    }
}
