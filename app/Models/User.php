<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable 
{
    use Notifiable;

    protected $fillable = [
      'name',
      'image',
      'email',
      'password',
      'email_verified_at',
     'role_id'


    ];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function orders()
    {
        return $this->hasMany(related: Order::class);
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}

