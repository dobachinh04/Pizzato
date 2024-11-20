<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected  $fillable = [
        'name',
        'code',
        'qty',
        'min_purchase_amount',
        'expire_date',
        'discount_type',
        'discount',
        'status',

    ];
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function getExpireDateDateAttribute()
    {
        return \Carbon\Carbon::parse($this->expire_date)->format('d/m/Y');
    }

    public function getExpireDateTimeAttribute()
    {
        return \Carbon\Carbon::parse($this->expire_date)->format('H:i');
    }
}
