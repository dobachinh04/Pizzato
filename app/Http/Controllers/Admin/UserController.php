<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::get();

        return view(
            'admin.users.create',
            [
                'roles' => $roles
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if ($request->isMethod('POST')) {
            $param = $request->except('__token');

            if ($request->hasFile('image')) {
                $filename = $request->file('image')->store('uploads/user', 'public');
            } else {
                $filename = null;
            }
            $param['image'] = $filename;
            if (!empty($param['password'])) {
                $param['password'] = Hash::make($param['password']);
            }
            User::create($param);

            return redirect()
                ->route('admin.users.index')
                ->with('errors', 'Thêm thành công');
        }
    }

  
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::with('role')->findOrFail($id);
        $roles = Role::get();

        return view(
            'admin.users.update',
            [
                'user' => $user,
                'roles' => $roles
            ]
        );
    }

 
    public function update(UpdateUserRequest $request, string $id)
    {
        $users = User::findOrFail($id);

        if ($request->isMethod('PUT')) {
            $param = $request->except('__token', '__method');
            $users->update($request->validated());

            if ($request->hasFile('image')) {
                if ($users->image && Storage::disk('public')->exists($users->image)) {
                    Storage::disk('public')->delete($users->image);
                }
                $filename = $request->file('image')->store('uploads/user', 'public');
            } else {
                $filename = $users->image;
            }
            $param['image'] = $filename;

            $users->update($request->all());

            return redirect()
                ->route('admin.users.index')
                ->with('errors', 'Sửa thành công');
        }
    }

    
    public function destroy(string $id)
    {
        $users = User::findOrFail($id);

        if ($users->image && Storage::disk('public')->exists($users->image)) {
            Storage::disk('public')->delete($users->image);
        }

        $users->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('errors', 'Xóa thành công');
    }
}
//