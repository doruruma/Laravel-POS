<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    
    public function index() 
    {
        if (request()->ajax()) {
            $categories = Category::all();
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('Action', function ($categories) {
                    return view('category.datatable_column', compact('categories'));
                })
                ->removeColumn('id')
                ->rawColumns(['Action'])
                ->make(true);
        }
        return view('category.index');
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
