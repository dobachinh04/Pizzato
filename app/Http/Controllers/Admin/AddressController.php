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

    public function create()
    {
        $users = User::all();
        $delivery_areas = DeliveryArea::all();

        return view('admin.addresses.create', compact('users', 'delivery_areas'));
    }

    public function store(StoreAddressRequest $request)
    {
        // Tạo một địa chỉ mới
        Address::create($request->all());

        return redirect()
            ->route('admin.addresses.index')
            ->with('success', 'Địa chỉ đã được thêm thành công!');
    }

    public function show(string $id) {}

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

    public function update(UpdateAddressRequest $request, Address $address)
    {
        // Cập nhật địa chỉ
        $address->update($request->all());

        // Redirect về trang danh sách với thông báo thành công
        return redirect()
            ->route('admin.addresses.index')
            ->with('success', 'Địa chỉ đã được cập nhật thành công!');
    }

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
