<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function createProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'price' => 'numeric|required',
            'image' => 'image|required',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'error',
                'errorMessage' => $validator->errors(),
            ]);
        }

        $files = $request->allFiles();
        $result = "";
        if (isset($files['image'])) {
            $newFolder = "upload/productimg/";
            // function upload //
            $result = $this->uploadImage($newFolder, $files['image'], 'product', "", "");// เก็บ image

        }

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $result,
        ]); // สร้างสินค้า

        return response([
            'message' => 'ok',
            'description' => 'สร้างสินค้าสำเร็จ',
            'data' => Product::all(),
        ]);
    }

    public function deleteProduct($id)
    {

        Product::find($id)->delete();

        return response([
            'message' => 'ok',
            'description' => 'ลบสินค้าสำเร็จ',
            'data' => Product::all(),
        ]);
    }

    public function updateProduct(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'numeric|required',
            'name' => 'string|required',
            'price' => 'numeric|required',
            'image' => 'image|nullable',
            'image_path' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return response([
                'message' => 'error',
                'errorMessage' => $validator->errors(),
            ]);
        }

        $files = $request->allFiles();
        $result = "";
        if (isset($files['image'])) {
            $newFolder = "upload/productimg/";
            // function upload //
            $result = $this->uploadImage($newFolder, $files['image'], 'product', "", "");// เก็บ image
        } else {
            $result = $request->image_path;
        }

        Product::find($request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $result,
        ]);

        return response([
            'message' => 'ok',
            'description' => 'แก้ไขสินค้าสำเร็จ',
            'data' => Product::find($request->id),
        ]);
    }
}
