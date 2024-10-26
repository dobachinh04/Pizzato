<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductGallery;
use App\Models\ProductOption;
use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'thumb_image',
        'category_id',
        'view',
        'short_description',
        'long_description',
        'price',
        'offer_price',
        'qty',
        'sku',
        'show_at_home',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
        'show_at_home' => 'boolean',
    ];

    function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    // function productImages(): HasMany
    // {
    //     return $this->hasMany(ProductGallery::class);
    // }

    function productSizes(): HasMany
    {
        return $this->hasMany(ProductSize::class);
    }

    function productOptions(): HasMany
    {
        return $this->hasMany(ProductOption::class);
    }
}
