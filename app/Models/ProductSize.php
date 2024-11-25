<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'image',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_product_sizes', 'product_size_id', 'product_id')
            ->withPivot('price')
            ->withTimestamps();
    }
}
