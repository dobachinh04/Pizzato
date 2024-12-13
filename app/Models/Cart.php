<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;
    // protected $table = 'cart';
    // protected $fillable = [
    //     'user_id',
    //     'product_id',
    //     'coupons_id',
    //     'quantity',
    //     'grand_total',
    // ];
    protected $fillable = [
        'product_id',
        'price',
        'qty',
        'product_size',
        'pizza_edge',
        'pizza_base',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    // public function user(): BelongsTo
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function coupon(): BelongsTo
    // {
    //     return $this->belongsTo(Coupon::class);
    // }
}
