<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return response()->json(['status' => "success", 'msg' => 'Categories', 'data' => ['categories' => $categories]], 200);
    }
    public function indexAll()
    {
        $categories = Category::get();
        return response()->json(['status' => "success", 'msg' => 'Categories', 'data' => ['categories' => $categories]], 200);
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string',
        ]);
        $data = [
            'name' => $request->name,
            'user_id' => Auth::user()->id
        ];
        $category = Category::create($data);
        return response()->json(['status' => "success", 'msg' => 'Add Successfully', 'data' => ['category' => $data]], 200);
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return response()->json(['status' => "success", 'msg' => 'Add Successfully', 'data' => $category], 200);
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id)->update(['name' => $request->name]);
        return response()->json(['status' => "success", 'msg' => 'Update Successfully', 'data' => []], 200);
    }
    public function delete(Request $request, $id)
    {
        $category = Category::find($id)->delete();
        return response()->json(['status' => "success", 'msg' => 'Deleted Successfully', 'data' => []], 200);
    }
}
