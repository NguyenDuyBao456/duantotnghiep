<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;

class SubcategoryController extends Controller
{

    public function index()
    {
        $subcategories = Subcategory::with('category')->get()
        ->map(function ($subcategory) {
            return [
                'id' => $subcategory->id,
                'name' => $subcategory->name,
                'category_name' => $subcategory->category ? $subcategory->category->name : null
            ];
        });

    return response()->json($subcategories);
    }


    public function getByCategory($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id'
        ]);

        $subcategory = Subcategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id
        ]);

        return response()->json($subcategory, 201);
    }
}

