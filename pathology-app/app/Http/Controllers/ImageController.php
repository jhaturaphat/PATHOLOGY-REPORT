<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    
    public function uploadImage(Request $request)
        {
            $image = $request->file('image');

            // อ่านไฟล์รูปภาพเป็น binary
            $imageData = file_get_contents($image->getRealPath());

            // บันทึกข้อมูลรูปภาพในฐานข้อมูล
            Image::create([
                'image_data' => $imageData,
            ]);

            return response()->json(['message' => 'Image uploaded successfully']);
        }
}
