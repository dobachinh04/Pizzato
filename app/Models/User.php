<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable,
    HasFactory;

    protected $fillable = [
        'name',
        'image',
        'email',
        'password',
        'email_verified_at',
        'role_id',
        'phone',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orders()
    {
        return $this->hasMany(related: Order::class);
    }

    public function address()
    {
        return $this->hasMany(related: Address::class);
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    //Thêm phương thức để lấy địa chỉ của người dùng:
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
