<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    
    public function index() 
    {
        $categories = Category::without('products')->get();
        return view('category.index', compact('categories'));
    }

    public function get($category)
    {
        return response()->json(Category::without('products')->find($category));
    }
    
    public function store(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'description' => 'required|min:5',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        Category::create($req->all());
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'description' => 'required|min:5',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        Category::where('id', $id)->update([
            'name' => $req->name,
            'description' => $req->description
        ]);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect(route('category'))->with([
            'type' =>  'success',
            'message' => 'Berhasil Hapus Data'
        ]);
    }

}
