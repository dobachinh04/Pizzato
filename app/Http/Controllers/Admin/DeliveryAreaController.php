<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDeliveryAreaRequest;
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
    public function store(StoreDeliveryAreaRequest $request )
    {
        // Tạo mới khu vực giao hàng với dữ liệu đã xác thực
        DeliveryArea::create($request->validated());
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
