<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DonHang;
use App\Models\DonHangChiTiet;
use App\Models\Product;
use App\Models\VanChuyen;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    public function createOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'MaKH' => 'required|exists:khachhang,MaKH',
            'MaPTTT' => 'required|exists:phuongthuctt,MaPTTT',
            'MaVC' => 'nullable|exists:vanchuyen,MaVC',
            'items' => 'required|array',
            'items.*.MaSP' => 'required|exists:sanpham,MaSP',
            'items.*.SoLuong' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $order = DonHang::create([
            'MaKH' => $request->MaKH,
            'MaPTTT' => $request->MaPTTT,
            'MaVC' => $request->MaVC,
            'TrangThai' => 'pending',
            'NgayDat' => now(),
            'TongTien' => 0
        ]);

        $totalPrice = 0;
        foreach ($request->items as $item) {
            $sanPham = SanPham::find($item['MaSP']);
            $gia = $sanPham->Gia;
            $thanhTien = $gia * $item['SoLuong'];
            $totalPrice += $thanhTien;

            DonHangChiTiet::create([
                'MaDH' => $order->MaDH,
                'MaSP' => $item['MaSP'],
                'Gia' => $gia,
                'SoLuong' => $item['SoLuong']
            ]);
        }

        $order->update(['TongTien' => $totalPrice]);

        return response()->json(['message' => 'Đơn hàng đã được tạo', 'order' => $order], 201);
    }


    public function getOrders()
    {
        $orders = DonHang::with('khachhang', 'phuongthuctt', 'vanchuyen')->get();
        return response()->json($orders);
    }


    public function getOrderDetail($id)
    {
        $order = DonHang::with(['khachhang', 'phuongthuctt', 'vanchuyen', 'donhangchitiet.sanpham'])->find($id);

        if (!$order) {
            return response()->json(['message' => 'Đơn hàng không tồn tại'], 404);
        }

        return response()->json($order);
    }


    public function updateOrder(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'TrangThai' => 'required|in:pending,processing,shipped,completed,canceled'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $order = DonHang::find($id);

        if (!$order) {
            return response()->json(['message' => 'Đơn hàng không tồn tại'], 404);
        }

        $order->update(['TrangThai' => $request->TrangThai]);

        return response()->json(['message' => 'Cập nhật đơn hàng thành công', 'order' => $order]);
    }


    public function deleteOrder($id)
    {
        $order = DonHang::find($id);

        if (!$order) {
            return response()->json(['message' => 'Đơn hàng không tồn tại'], 404);
        }

        $order->delete();

        return response()->json(['message' => 'Đơn hàng đã bị xóa']);
    }
}
