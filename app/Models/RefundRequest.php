<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundRequest extends Model
{
    use HasFactory;
    protected $table = 'refund_request';
    protected $fillable = [
        'name',
        'email',
        'invoice_id',
        'refund_amount',
        'refund_reason',
        'bank_number',
        'bank_type',
        'status',
        'admin_note',
    ];

    // Liên kết với bảng orders
    public function order()
    {
        return $this->belongsTo(Order::class, 'invoice_id', 'invoice_id');
    }
}
