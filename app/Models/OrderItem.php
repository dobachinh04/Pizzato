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
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
