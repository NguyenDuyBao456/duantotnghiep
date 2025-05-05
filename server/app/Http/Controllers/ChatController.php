<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ChatController extends Controller
{
    //

    public function chat(Request $request){
        $apiKey = env('API_KEY');

        $userMessage = $request->message;


        $products = Products::all()->toJson();





        $response = Http::withHeaders([
            'Authorization' => "Bearer $apiKey",
            'Content-Type' => 'application/json',
        ])->post('https://api.mistral.ai/v1/chat/completions', [
            'model' => 'mistral-medium',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => "Bạn là một trợ lý AI hỗ trợ khách hàng, trả lời bằng Tiếng Việt.
                Chỉ sử dụng dữ liệu sản phẩm bên dưới khi người dùng có câu hỏi liên quan đến sản phẩm (ví dụ như: hỏi về giá, tên, mô tả sản phẩm, hình ảnh, v.v.).
                Nếu người dùng không nhắc đến sản phẩm, hãy bỏ qua dữ liệu này.
                Dữ liệu sản phẩm JSON: $products.
                Đường dẫn hình ảnh là http://localhost:8000/img/ + tên ảnh. Nếu người dùng hỏi hình ảnh thì gán thẻ img thể hiện ra",
                ],

                [
                    'role' => 'user',
                    'content' => $userMessage,
                ],
            ],
            'max_tokens' => 1000,
            'temperature' => 0.7,
        ]);

        if ($response->successful()) {
            return response()->json($response->json());
        } else {
            return response()->json(['error' => 'API gọi thất bại'], 500);
        }
    }
}
