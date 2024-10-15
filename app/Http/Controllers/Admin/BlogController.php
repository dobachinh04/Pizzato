<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\BlogCategory;
use App\Models\Category;
use App\Models\User;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::get();
        return view('admin.blogs.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lấy tất cả người dùng
        $users = User::get();
        
        // Lấy tất cả danh mục
        $blogCategories = BlogCategory::get(); // Giả sử bạn đã định nghĩa model BlogCategory
    
        // Trả về view với cả người dùng và danh mục
        return view('admin.blogs.create', ['users' => $users, 'blogCategories' => $blogCategories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlogRequest $request)
    {
    
    
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'category_id' => 'required|exists:blog_categories,id', // Đừng quên kích hoạt lại quy tắc này nếu cần
            'image' => 'required|image|max:2048',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'description' => 'nullable|string',
            // 'status' => 'required|in:active,inactive', // Nếu bạn cần kiểm tra status
        ]);
    
        $param = $request->except('__token');
       
    
        if (is_null($param['user_id'])) {
            return redirect()->back()->with('error', 'Không tìm thấy người dùng.');
        }
    
        if ($request->hasFile('image')) {
            $param['image'] = $request->file('image')->store('uploads/blog', 'public');
        }
    
        Blog::create($param);
    
        return redirect()->route('admin.blogs.index')->with('success', 'Thêm thành công');
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
    
        // Lấy tất cả danh mục
        $blogCategories = Category::all();
    
        // Trả về view sửa blog với dữ liệu hiện tại
        return view('admin.blogs.update', compact('blog', 'users', 'blogCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlogRequest $request, Blog $blog)
{
    // Xác thực dữ liệu đầu vào
    $request->validate([
        'category_id' => 'required|exists:blog_categories,id',
        'image' => 'nullable|image|max:2048', // Hình ảnh có thể không cần thiết
        'title' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
        'description' => 'nullable|string',
        'status' => 'required|in:0,1', // Trạng thái phải là 0 hoặc 1
    ]);

    // Cập nhật các thông tin blog
    $blog->fill($request->except('image'));

    // Nếu có hình ảnh mới, lưu lại
    if ($request->hasFile('image')) {
        // Xóa hình ảnh cũ nếu có
        if ($blog->image) {
            \Storage::disk('public')->delete($blog->image);
        }
        $blog->image = $request->file('image')->store('uploads/blog', 'public');
    }

    // Lưu thay đổi
    $blog->save();

    return redirect()->route('admin.blogs.index')->with('success', 'Cập nhật thành công');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        // Xóa hình ảnh nếu có
        if ($blog->image) {
            \Storage::disk('public')->delete($blog->image);
        }
    
        // Xóa blog
        $blog->delete();
    
        return redirect()->route('admin.blogs.index')->with('success', 'Xóa thành công');
    }
    
}
