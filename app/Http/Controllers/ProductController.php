<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $products = Product::all();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('category', function ($products) {
                    return $products->category->name;
                })
                ->addColumn('Action', function ($products) {
                    return view('product.datatable_column', compact('products'));
                })
                ->removeColumn('id')
                ->rawColumns(['Action', 'category'])
                ->make(true);
        }
        $categories = Category::without('products')->get();
        return view('product.index', compact('categories'));
    }

    public function get($product)
    {
        return response()->json(Product::find($product));
    }

    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'category_id' => 'required'
        ]);
        Product::create($data);
        return redirect(route('product'))->with([
            'type' => 'success',
            'message' => 'Berhasil Input Data'
        ]);
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|min:3',
            'description' => 'required|min:5',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'category' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        Product::where('id', $id)->update([
            'name' => $req->name,
            'description' => $req->description,
            'stock' => $req->stock,
            'price' => $req->price,
            'category_id' => $req->category
        ]);
    }

    public function delete(Product $product)
    {
        $product->delete();
        return redirect(route('product'))->with([
            'type' => 'success',
            'message' => 'Berhasil Menghapus Data'
        ]);
    }
}
