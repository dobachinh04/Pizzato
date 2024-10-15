<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = sliders::get();
        return view('admin.sliders.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Kiểm tra hình ảnh
            'offer' => 'nullable|string|max:255', // Offer có thể bỏ trống
            'title' => 'required|string|max:255', // Title bắt buộc
            'sub_title' => 'nullable|string|max:255', // Sub Title có thể bỏ trống
            'short_description' => 'nullable|string|max:500', // Mô tả ngắn
            'button_link' => 'nullable|url|max:255', // Nút đường dẫn
            'status' => 'required|boolean', // Trạng thái bắt buộc
            'created_at' => 'nullable|date', // Thời gian tạo (có thể bỏ trống)
            'updated_at' => 'nullable|date', // Thời gian cập nhật (có thể bỏ trống)
        ]);
        if($request->isMethod('POST')){
            $param = $request->except('__token');
            if($request->hasFile('image')){
                $filename = $request->file('image')->store('uploads/slider', 'public');
            }else{
                $filename = null;
            }
            $param['image'] = $filename;
            Sliders::create($param);
            return redirect()->route('admin.sliders.index')->with('errors','Thêm thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $slider = sliders::findOrFail($id);
    
        // Trả về view sửa blog với dữ liệu hiện tại
        return view('admin.sliders.update', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sliders = Sliders::findOrFail($id);
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Hình ảnh là tùy chọn
            'offer' => 'nullable|string|max:255', // Offer có thể bỏ trống
            'title' => 'required|string|max:255', // Title là bắt buộc
            'sub_title' => 'nullable|string|max:255', // Sub Title có thể bỏ trống
            'short_description' => 'nullable|string|max:500', // Mô tả ngắn
            'button_link' => 'nullable|url|max:255', // Nút đường dẫn
            'status' => 'required|boolean', // Trạng thái bắt buộc
        ]);
        if($request->isMethod('PUT')){
            $param = $request->except('__token','__method');
         
            if($request->hasFile('image')){
                if($sliders->image && Storage::disk('public')->exists($sliders->image)){
                    Storage::disk('public')->delete($sliders->image);
                }
                $filename = $request->file('image')->store('uploads/user', 'public');
            }else{
                $filename = $sliders->image;
            }
            $param['image'] = $filename;
            $sliders->update($param);
            return redirect()->route('admin.sliders.index')->with('errors','Sửa thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sliders = Sliders::findOrFail($id);
      
        if($sliders->image && Storage::disk('public')->exists($sliders->image)){
            Storage::disk('public')->delete($sliders->image);
        }
        $sliders->delete();
        return redirect()->route('admin.sliders.index')->with('errors','Xóa thành công');
    }
    }

