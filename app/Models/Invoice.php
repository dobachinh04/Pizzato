<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'email_verified_at',
        'role_id'
    ];

    public function orders()
    {
        return $this->hasMany(related: Order::class);
    }
}
