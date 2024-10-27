<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EncryptionModel extends Model
{
    /**
     * Giải mã Product ID đã được mã hóa.
     *
     * @param string $encodedId
     * @return int|null
     */
    public static function decodeId($encodedId)
    {
        $secretString = env('PRODUCT_SECRET_STRING');
        $decodedId = base64_decode($encodedId, true);
        if ($decodedId === false || strpos($decodedId, $secretString) === false) {
            return null;
        }
        $productId = str_replace($secretString, '', $decodedId);
        if (!is_numeric($productId)) {
            return null;
        }
        return (int) $productId; 
    }

    /**
     * Mã hóa Product ID.
     *
     * @param int $productId
     * @return string
     */
    public static function encodeId($productId)
    {
        $secretString = env('PRODUCT_SECRET_STRING');
        return base64_encode($productId . $secretString);
    }
}
