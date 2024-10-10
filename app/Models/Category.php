<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'status',
        'show_at_home',
    ];

    //Định nghĩa một scope để lấy ra các danh mục hiển thị ở trang chủ.
    // public function scopeShowAtHome($query)
    // {
    //     return $query->where('show_at_home', 1);
    // }
}

