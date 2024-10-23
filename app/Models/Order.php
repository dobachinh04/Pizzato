<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'user_id ',
        'address',
        'discount ',
        'delivery_charge',
        'subtotal',
        'grand_total',
        'product_qty',
        'payment_method',
        'payment_status',
        'payment_approve_date',
        'transaction_id',
        'coupon_info',
        'currency_name',
        'order_status',
        'address_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function invoices()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function addresses()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
