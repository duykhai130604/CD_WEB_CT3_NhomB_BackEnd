<?php

namespace App\Models;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloudinaryModel extends Model
{
    // Upload images
    public static function uploadImage($image)
    {
        try {
            // Upload ảnh lên Cloudinary
            $uploadedFile = Cloudinary::upload($image->getRealPath());
            // Trả về thông tin nếu upload thành công
            return [
                'secure_url' => $uploadedFile->getSecurePath(),
                'public_id' => $uploadedFile->getPublicId(),
                'status' => 'success'
            ];
        } catch (\Exception $e) {
            return [
                'status' => 'error',
                'message' => 'Failed to upload image'
            ];
        }
    }



    // // Get all images
    // public static function getAllImages()
    // {
    //     $resources = Cloudinary::admin()->assets(['type' => 'upload']);

    //     $images = [];
    //     foreach ($resources['resources'] as $resource) {
    //         $images[] = [
    //             'secure_url' => $resource['secure_url'],
    //             'public_id' => $resource['public_id'],
    //         ];
    //     }

    //     return ['status' => 'success', 'message' => $images];
    // }

    public static function deleteImage($public_id)
    { 
        $result = Cloudinary::destroy($public_id);
        if ($result['result'] === 'ok') {
            return [
                'status' => 'success'
            ];
        }

        return [
            'status' => 'error',
            'message' => 'Delete image unsuccessfully'
        ];
    }

    // // Update images
    // public static function updateImages($publicIds, $images)
    // {
    //     self::deleteImages($publicIds);
    //     self::uploadImage($images);
    //     return ['status' => 'success', 'message' => 'Update successfully'];
    // }
}
