<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryAreaRequest;
use App\Http\Requests\UpdateDeliveryAreaRequest;
use App\Models\DeliveryArea;
use Illuminate\Http\Request;

class DeliveryAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $areas = DeliveryArea::all();
        return view('admin.delivery_areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.delivery_areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDeliveryAreaRequest $request)
    {
         // Nếu không có giá trị cho status, mặc định là 1
         $validatedData = $request->validated();
         $validatedData['status'] = $validatedData['status'] ?? 1;
 
         // Tạo mới khu vực giao hàng với dữ liệu đã xác thực
         DeliveryArea::create($validatedData); // Sử dụng $validatedData ở đây
 
         // Chuyển hướng về trang danh sách và hiển thị thông báo thành công
         return redirect()->route('admin.delivery_areas.index')->with('success', 'Khu vực giao hàng đã được tạo thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryArea $blogCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Lấy khu vực giao hàng theo ID
        $area = DeliveryArea::findOrFail($id);
        // Trả về view để chỉnh sửa khu vực giao hàng
        return view('admin.delivery_areas.update', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDeliveryAreaRequest $request, $id)
    {
         // Tìm khu vực giao hàng theo ID
         $area = DeliveryArea::findOrFail($id);
        
         // Cập nhật khu vực giao hàng với dữ liệu đã xác thực
         $validatedData = $request->validated();
         $area->update($validatedData); // Cập nhật với dữ liệu đã xác thực
 
         // Chuyển hướng về trang danh sách và hiển thị thông báo thành công
         return redirect()->route('admin.delivery_areas.index')->with('success', 'Khu vực giao hàng đã được cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Tìm khu vực giao hàng theo ID và xóa nó
        $area = DeliveryArea::findOrFail($id);
        $area->delete();
        // Chuyển hướng về trang danh sách và hiển thị thông báo thành công
        return redirect()->route('admin.delivery_areas.index')->with('success', 'Khu vực giao hàng đã được xóa thành công.');
    }
}
