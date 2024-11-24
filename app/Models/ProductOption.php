<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOption extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'product_id',
    //     'size_id',
    //     'edge_id',
    //     'base_id',
    //     'price',
    // ];

    // public function product()
    // {
    //     return $this->belongsTo(Product::class);
    // }

    // public function size()
    // {
    //     return $this->belongsTo(ProductSize::class, 'size_id');
    // }

    // public function edge()
    // {
    //     return $this->belongsTo(PizzeEdge::class, 'edge_id');
    // }

    // public function base()
    // {
    //     return $this->belongsTo(PizzeBase::class, 'base_id');
    // }
}
