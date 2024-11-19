<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'review',
        'status',
        'approved_at',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

public function product()
{
    return $this->belongsTo(Product::class);
}

protected $casts = [
    'status' => 'boolean', // Trường status sẽ được cast thành kiểu boolean
    'rating' => 'float',   // Trường rating sẽ tự động là kiểu float
    'approved_at' => 'datetime', // Trường approved_at sẽ là instance của Carbon
];
}
