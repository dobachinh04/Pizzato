<?php

namespace App\Models;

use App\Models\Category;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    function productGalleries(): HasMany
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function productSizes()
    {
        return $this->belongsToMany(ProductSize::class, 'product_product_sizes', 'product_id', 'product_size_id')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function pizzaEdges()
    {
        return $this->belongsToMany(PizzaEdge::class, 'product_pizza_edges', 'product_id', 'pizza_edge_id')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function pizzaBases()
    {
        return $this->belongsToMany(PizzaBase::class, 'product_pizza_bases', 'product_id', 'pizza_base_id')
            ->withPivot('price')
            ->withTimestamps();
    }

    public function getStatusAttribute()
    {
        return $this->qty > 0;
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class);
    }
}
