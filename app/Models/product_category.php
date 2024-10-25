<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_category extends Model
{
    protected $table = 'product_category';
    public function addProductCategory(array $productIds, $categoryId)
    {
        $data = [];
        foreach ($productIds as $productId) {
            $data[] = [
                'product_id' => $productId,
                'category_id' => $categoryId,
            ];
        }
        return $this->insert($data);
    }
    public function deleteProductCategory(array $productIds, $categoryId)
    {
        return $this->whereIn('product_id', $productIds)
            ->where('category_id', $categoryId)
            ->delete();
    }

    use HasFactory;
}
