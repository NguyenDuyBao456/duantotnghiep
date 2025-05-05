<?php

namespace App\Http\Controllers;

use App\Models\Subcategories;
use Illuminate\Http\Request;

class SubcategoriesController extends Controller
{
    //
    public function index() {
        $subcategoris = Subcategories::all();
        return response()->json($subcategoris);
    }

    public function store(Request $request) {
        Subcategories::create($request->all());
        return response()->json(['message' => 'Danh mục con đã được thêm']);
    }

    public function update(Request $request, string $id) {
        $subcate = Subcategories::find($id);
        $subcate->update($request->all());
        return response()->json(["message" => 'success']);
    }

    public function destroy(string $id) {
        $subcate = Subcategories::find($id);
        $subcate->delete();
        return response()->json(["message" => 'Danh mục con đã bị xóa']);
    }
}
