<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrderModel extends Model
{
    use HasFactory;
    protected $table = 'product_order';
    protected $fillable = [
        'product_variant_id',
        'order_id',
        'quantity',
        'total'
    ];
    
}
