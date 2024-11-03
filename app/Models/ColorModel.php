<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColorModel extends Model
{
    use HasFactory;
    protected $table = 'colors';
    public static function getAllColors()
    {
        $colors = self::select('id', 'name')->get();
        if (!$colors) {
            return response()->json([
                ['status' => 'error', 'message' => 'Colors not found']
            ]);
        }
        $colors = $colors->map(function ($color) {
            return [
                'id' => EncryptionModel::encodeId($color->id),
                'name' => $color->name,
            ];
        });
        return response()->json([
            "status" => "success",
            "colors" => $colors
        ]);
    }
    public function color()
    {
        return $this->belongsTo(ColorModel::class, 'color_id');
    }
}
