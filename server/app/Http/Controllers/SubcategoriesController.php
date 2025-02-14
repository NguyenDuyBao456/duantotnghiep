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
}
