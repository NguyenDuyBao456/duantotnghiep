<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Preview;

class PreviewController extends Controller
{

    public function index($id_product)
    {
        $reviews = Preview::where('id_product', $id_product)->get();
        return response()->json($reviews);
    }


    public function create(Request $request)
    {
        $review = Preview::create($request->all());
        return response()->json(['message' => 'Đánh giá đã được thêm!', 'data' => $review], 201);
    }


    public function destroy($MaDG)
    {
        $review = Preview::find($MaDG);
        if (!$review) {
            return response()->json(['message' => 'Không tìm thấy đánh giá'], 404);
        }
        $review->delete();
        return response()->json(['message' => 'Đánh giá đã bị xóa!']);
    }

    public function update(Request $request ,$MaDG) {
        $preview = Preview::find($MaDG);

        $preview->update($request->all());

        return response()->json(['message' => 'Cập nhật đánh giá thành công!'], 200);

    }

    public function getPreview(){
        $preview = Preview::all();
        return view('review', compact("preview"));
    }
}

