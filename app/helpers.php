<?php

use Illuminate\Support\Str;
use App\Models\Admin\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


if (!function_exists('storeImage')) {
    function storeImage($image, $folder)
    {
        $path = "images/$folder"; // Update the path to match your desired directory structure

        $full_path = Storage::disk('public')->path($path);

        if (!File::exists($full_path)) {
            File::makeDirectory($full_path, 0755, true);
        }

        $new_image_name = time() . "-" . rand(100000, 999999) . "." . $image->extension();
        $image->storeAs($path, $new_image_name, 'public');

        $full_path = url("storage/$path/$new_image_name"); // Generate the full path

        return $full_path;
    }
}

if (!function_exists('removeImage')) {
    function removeImage($path)
    {
        Storage::disk('public')->delete($path);
    }
}

if (!function_exists('JsonResponse')) {
    // Generic Function For Response
    function JsonResponse($status, $state, $message, $data)
    {
        return response()->json([
            'status' => $status,
            'state' => $state,
            'message' => $message,
            'data' => $data
        ]);
    }
};
