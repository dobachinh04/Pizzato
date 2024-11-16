<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getBlog()
    {
        $blog = Blog::all();

        return response()->json([
            'success' => true,
            'blog' => $blog,
        ]);
    }

    public function getBlogDetail(String $id)
    {
        $blog = Blog::findOrFail($id);

        return response()->json([
            'success' => true,
            'blog' => $blog,
        ]);
    }
}
