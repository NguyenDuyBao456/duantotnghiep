<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    //

    public function upload(Request $request) {
        if($request->hasFile("img")) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName); // Lưu ảnh vào thư mục public/img

            return response()->json(["img" => $imageName]);
        } else {
            return response()->json(["img" => ""]);
        }
    }
}
