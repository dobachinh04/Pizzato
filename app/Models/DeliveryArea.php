<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_name',
        'min_delivery_time',
        'max_delivery_time',
        'delivery_fee',
        'status',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
