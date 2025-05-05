<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        //
        $products = Products::all();
        return response()->json($products);
    }

    public function show(string $id)
    {
        //

        $product = Products::where("id", "=", $id)->first();

        if(!$product) {
            return response()->json(
                ['message' => 'Product Not Found'], 404
            );
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Products::find($id);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName); // Lưu ảnh vào thư mục public/img
            $product->img = $imageName; // Cập nhật tên ảnh trong cơ sở dữ liệu
        }

        $product->name = $request->name;
        $product->price = $request->price;
        $product->size = $request->size;
        $product->description = $request->description;

        $product->save(); // Lưu sản phẩm vào cơ sở dữ liệu


        return response()->json(['message' => 'Cập nhật sản phẩm thành công!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::find($id);
        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy '], 404);
        }
        $product->delete();
        return response()->json(['message' => 'Sản phẩm đã bị xóa!']);
    }

    public function getProducts() {
        $products = Products::orderBy('id', 'desc')->paginate(5); // 👈 Đảo ngược theo ID


        return view("product", compact('products'));
    }

    public function store(Request $request)
    {



    $fileName = time() . '.' . $request->img->extension();
    $request->img->move(public_path('img'), $fileName);

    Products::create([
        'name' => $request->name,
        'price' => $request->price,
        'size' => $request->size,
        'description' => $request->description,
        'img' => $fileName,
        'categories_id' => $request->categories_id,
        'subcategories_id' => $request->subcategories_id
    ]);

    return response()->json(['message' => 'Sản phẩm đã được thêm']);
    }

}
