<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;

use App\Models\DeliveryArea;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::all();

        return view('admin.addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $delivery_areas = DeliveryArea::all();

        return view('admin.addresses.create', compact('users', 'delivery_areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAddressRequest $request)
    {
        // Tạo một địa chỉ mới
        Address::create($request->all());

        // Redirect về trang danh sách với thông báo thành công
        return redirect()
            ->route('admin.addresses.index')
            ->with('success', 'Địa chỉ đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address = Address::findOrFail($id);
        $users = User::all();
        $delivery_areas = DeliveryArea::all();

        return view(
            'admin.addresses.update',
            compact('address', 'users', 'delivery_areas')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        // Cập nhật địa chỉ
        $address->update($request->all());

        // Redirect về trang danh sách với thông báo thành công
        return redirect()
            ->route('admin.addresses.index')
            ->with('success', 'Địa chỉ đã được cập nhật thành công!');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        // Xóa địa chỉ
        $address->delete();

        // Redirect về trang danh sách với thông báo thành công
        return redirect()
            ->route('admin.addresses.index')
            ->with('success', 'Địa chỉ đã được xóa thành công!');
    }
}
