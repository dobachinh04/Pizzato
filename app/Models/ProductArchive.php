<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductArchive extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'thumb_image',
        'category_id',
        'short_description',
        'long_description',
        'price',
        'offer_price',
        'qty',
        'sku',
    ];
}
