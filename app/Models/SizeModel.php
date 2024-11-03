<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SizeModel extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    public static function getAllSizes()
    {
        $sizes = self::select('id', 'name')->get();
        if (!$sizes) {
            return response()->json([
                ['status' => 'error', 'message' => 'Size not found']
            ]);
        }

        $sizes = $sizes->map(function ($size) {
            return [
                'id' => EncryptionModel::encodeId($size->id),
                'name' => $size->name,
            ];
        });

        return response()->json([
            "status" => "success",
            "sizes" => $sizes
        ]);
    }
    public function size()
    {
        return $this->belongsTo(SizeModel::class, 'size_id'); // Đảm bảo 'size_id' là khóa ngoại trong bảng 'product_variants'
    }
}
