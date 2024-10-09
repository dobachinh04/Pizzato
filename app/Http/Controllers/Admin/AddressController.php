<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;

use App\Models\DeliveryArea;
use App\Http\Controllers\Controller;

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

        return view('admin.addresses.create',compact('users', 'delivery_areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'delivery_area_id' => 'required|integer',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'type' => 'required|string',
        ]);

        // Tạo một địa chỉ mới
        Address::create($request->all());

        // Redirect về trang danh sách với thông báo thành công
        return redirect()->route('admin.addresses.index')->with('success', 'Địa chỉ đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('admin.addresses.update', compact('address'));
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
