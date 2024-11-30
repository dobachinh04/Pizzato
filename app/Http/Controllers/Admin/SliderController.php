<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\sliders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
   
    public function index()
    {
        $sliders = sliders::get();
        return view('admin.sliders.index',compact('sliders'));
    }

  
    public function create()
    {
        return view('admin.sliders.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'offer' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'button_link' => 'nullable|url|max:255',
            'status' => 'required|boolean',
            'created_at' => 'nullable|date',
            'updated_at' => 'nullable|date',
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

            return redirect()
                ->route('admin.sliders.index')
                ->with('errors','Thêm thành công');
        }
    }

   
    public function show(string $id)
    {
        //
    }

    
    public function edit(string $id)
    {
        $slider = sliders::findOrFail($id);

        // Trả về view sửa blog với dữ liệu hiện tại
        return view('admin.sliders.update', compact('slider'));
    }

   
    public function update(Request $request, string $id)
    {
        $sliders = Sliders::findOrFail($id);
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'offer' => 'nullable|string|max:255',
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'button_link' => 'nullable|url|max:255',
            'status' => 'required|boolean',
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

            return redirect()
                ->route('admin.sliders.index')
                ->with('errors','Sửa thành công');
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

        return redirect()
            ->route('admin.sliders.index')
            ->with('errors','Xóa thành công');
    }
    }

