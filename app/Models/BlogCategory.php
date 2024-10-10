<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'status'];

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    //tạo một scope để lấy ra các danh mục có trạng thái status là 1 (bật)

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
