<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\User;
use App\Models\Category;
use App\Models\BlogCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::get();
        return view('admin.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lấy tất cả người dùng
        $users = User::get();

        // Lấy tất cả danh mục
        $blogCategories = BlogCategory::get();

        // Trả về view với cả người dùng và danh mục
        return view('admin.blogs.create', ['users' => $users, 'blogCategories' => $blogCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
        $param = $request->except('__token');

        if (is_null($param['user_id'])) {
            return redirect()->back()->with('error', 'Không tìm thấy người dùng.');
        }

        if ($request->hasFile('image')) {
            $param['image'] = $request->file('image')->store('uploads/blog', 'public');
        }

        Blog::create($param);

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $users = User::all();
        $blogCategories = Category::all();

        // Trả về view sửa blog với dữ liệu hiện tại
        return view('admin.blogs.update', compact('blog', 'users', 'blogCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
    {

        $blog->fill($request->except('image'));

        if ($request->hasFile('image')) {
            // Xóa hình ảnh cũ nếu có
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->image = $request->file('image')->store('uploads/blog', 'public');
        }

        $blog->save();

        return redirect()
            ->route('admin.blogs.index')
            ->with('success', 'Cập nhật thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')->with('success', 'Xóa thành công');
    }
}
