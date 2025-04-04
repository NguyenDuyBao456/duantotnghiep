<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;

class FavoriteController extends Controller
{

    public function index($id_user)
    {
        $favorites = Favorite::where('id_user', $id_user)->get();

        return response()->json($favorites);
    }


    public function store(Request $request)
    {
        $favorite = Favorite::create($request->all());
        return response()->json(['message' => 'Thêm vào yêu thích thành công!', 'data' => $favorite], 201);
    }


    public function destroy($MaYT)
    {
        $favorite = Favorite::find($MaYT);
        if (!$favorite) {
            return response()->json(['message' => 'Không tìm thấy mục yêu thích'], 404);
        }
        $favorite->delete();
        return response()->json(['message' => 'Xóa khỏi yêu thích thành công!']);
    }
}

