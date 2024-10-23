<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Http\Requests\StoreBlogCategoryRequest;
use App\Http\Requests\UpdateBlogCategoryRequest;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category_blog = BlogCategory::all();

        return view('admin.blog-categories.index', compact('category_blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.blog-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, StoreBlogCategoryRequest $blogcategoryrequest)
    {
        $blogcategoryrequest->run();
        BlogCategory::create($request->all());

        return redirect()
            ->route('admin.blog-categories.index')
            ->with('success', 'Blog Category added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BlogCategory $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, Request $request)
    {
        $category_blog = BlogCategory::findOrFail($id);
        $category_blog->update($request->all());

        return view('admin.blog-categories.update', compact('category_blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id, UpdateBlogCategoryRequest $blogcategoryrequest )
    {
        $blogcategoryrequest->run();
        $category_blog = BlogCategory::findOrFail($id);
        $category_blog->name = $request->input('name');
        $category_blog->slug = $request->input('slug');
        $category_blog->status = $request->input('status');
        $category_blog->save();

        return redirect()
            ->back()
            ->with('success', 'Category Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category_blog = BlogCategory::findOrFail($id);
        $category_blog->delete();

        return redirect()
            ->route('admin.blog-categories.index')
            ->with('success', 'Category Blog deleted successfully.');
    }
}
