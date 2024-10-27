<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sliders extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'offer',
        'title',
        'sub_title',
        'short_description',
        'button_link',
        'status',
    ];
}