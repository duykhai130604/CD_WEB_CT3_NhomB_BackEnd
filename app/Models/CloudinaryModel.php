<?php

namespace App\Models;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CloudinaryModel extends Model
{
    // Upload images
    public static function uploadImage($images) {
        $uploadedImages = [];
        foreach ($images as $image) {
            $uploadedFile = Cloudinary::upload($image->getRealPath());
            $uploadedImages[] = [
                'secure_url' => $uploadedFile->getSecurePath(),
                'public_id' => $uploadedFile->getPublicId(),
            ];
        }
        return ['status' => 'success', 'message' => $uploadedImages];
    }

    // Get all images
    public static function getAllImages()
    {
        $resources = Cloudinary::admin()->assets(['type' => 'upload']);

        $images = [];
        foreach ($resources['resources'] as $resource) {
            $images[] = [
                'secure_url' => $resource['secure_url'],
                'public_id' => $resource['public_id'],
            ];
        }

        return ['status' => 'success', 'message' => $images];
    }

    // Delete images
    public static function deleteImages($urls)
    {
        $deletedImages = [];
        foreach ($urls as $url) {
            Cloudinary::destroy($url);
            $deletedImages[] = $url;
        }
        return ['status' => 'success', 'message' => $deletedImages];
    }

    // Update images
    public static function updateImages($publicIds, $images){
        self::deleteImages($publicIds);
        self::uploadImage($images);
        return ['status' => 'success', 'message' => 'Update successfully'];
    }
}