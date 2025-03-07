<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    public function index()
    {
        return response()->json(Product::all(), 200);
    }


    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }
        return response()->json($product, 200);
    }


    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return response()->json($product, 201);
    }


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }
        $product->update($request->all());
        return response()->json($product, 200);
    }


    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Xóa sản phẩm thành công'], 200);
    }
}
