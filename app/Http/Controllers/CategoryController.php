<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{

    public function index(Request $request) {
        $categories = Category::select('id', 'category_name');
        if($request->ajax()){ 
            return datatables()->of($categories)
            ->addColumn('action', function($row) {
                return '<a href="javascript:void(0)" class="btn-sm btn btn btn-info editButton" data-id="'.$row->id.'">Edit</a>
                <a href="javascript:void(0)" class="btn-sm btn btn btn-danger delButton" data-id="'.$row->id.'">Delete</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }

    public function create () {
        return view('manage_categories');
    }

    public function store (Request $request) {
        if ($request->category_id != null){
            $category = Category::find($request->category_id);
            if(! $category) {
                abort(404);
            }
            $category->update([
                'category_name' => $request->category_name
            ]);

            return response()->json([
                'success' => 'Category Updated Successfully'
            ], 201);
        }
        else {

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

    public function edit ($id) {
        $category = Category::find($id);
        if(! $category) {
            abort(404);
        }
        return $category;
    }

    public function destroy($id) {
        $category = Category::find($id);
        if (! $category) {
            return response()->json([
                'error' => 'Category not found',
            ], 404);
        }
    
        $category->delete();
    
        return response()->json([
            'success' => 'Category Deleted',
        ], 200);
    }
    
}