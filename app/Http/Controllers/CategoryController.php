<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function gelAll()
    {
        $categories=Category::all();
        return response()->json($categories);
    }
    public function store(Request $request)
    {
        $categories= new Category();
        $categories->category_name = $request->input('category_name');
        $categories->save();
        return response()->json($categories,201);
    }

    public function update(Request $request,$category_id)
    {
        $category=Category::findOrFail($category_id);
        $category->category_name=$request->input('category_name');
        $category->save();
        return response()->json($category,202);
    }

    public function destroy($id)
    {
        $category=Category::findOrFail($id);
        $category->delete();
    }
}
