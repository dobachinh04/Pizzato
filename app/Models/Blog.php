<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
      'user_id', 
      'category_id', 
      
        'image',
        'title',
        'slug',
        'description',
       'status'
  
  
      ];
      public function users()
      {
          return $this->belongsTo(User::class);
      }
      public function blogCategory()
      {
          return $this->belongsTo(BlogCategory::class);
      }
    
}
