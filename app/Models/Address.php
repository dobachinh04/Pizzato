<?php

namespace App\Models;

use App\Models\DeliveryArea;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'delivery_area_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'address',
        'type'
      ];

      public function users()
      {
          return $this->belongsTo(User::class);
      }

      public function delivery_area()
      {
          return $this->belongsTo(DeliveryArea::class);
      }
}
