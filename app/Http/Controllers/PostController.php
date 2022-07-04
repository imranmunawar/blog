<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Auth;
use Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->with('category')->get();
        return response()->json(['status' => "success", 'msg' => 'Categories', 'data' => ['posts' => $posts]], 200);
    }
    public function indexAll()
    {
        $posts = Post::get();
        return response()->json(['status' => "success", 'msg' => 'Categories', 'data' => ['posts' => $posts]], 200);
    }
    public function indexOne($slug)
    {
        $post = Post::where('slug', $slug)->with('category')->first();
        return response()->json(['status' => "success", 'msg' => 'Categories', 'data' => $post], 200);
    }
    public function store(Request $request)
    {
        $attr = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
        ]);
        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->title)
        ];
        $post = Post::create($data);
        return response()->json(['status' => "success", 'msg' => 'Add Successfully', 'data' => $post], 200);
    }
    public function delete(Request $request, $id)
    {
        $post = Post::find($id)->delete();
        return response()->json(['status' => "success", 'msg' => 'Deleted Successfully', 'data' => []], 200);
    }
}
