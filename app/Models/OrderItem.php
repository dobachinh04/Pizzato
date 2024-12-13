<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'order_id',
        'product_id',
        'unit_price',
        'qty',
        'product_size',
        'product_option',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }


    public function productArchive()
    {
        return $this->belongsTo(ProductArchive::class, 'product_id', 'product_id');
    }
    // public function productArchive()
    // {
    //     return $this->belongsTo(ProductArchive::class, 'sku', 'sku');
    // }
}
