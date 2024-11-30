<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePizzaEdgeRequest;
use App\Http\Requests\UpdatePizzaEdgeRequest;
use App\Models\PizzaEdge;
use Illuminate\Support\Facades\Storage;

class PizzaEdgeController extends Controller
{
    const PATH_UPLOAD = 'products/pizza-edges';

    public function index()
    {
        $pizzaEdges = PizzaEdge::query()->latest('id')->get();
        return view('admin.pizza-edges.index', compact('pizzaEdges'));
    }

    public function create()
    {
        return view('admin.pizza-edges.create');
    }

    public function store(StorePizzaEdgeRequest $request)
    {
        // Xử lý ảnh
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        PizzaEdge::query()->create($data);

        return redirect()
            ->route('admin.pizza-edges.index')
            ->with('success', 'Thêm thành công');
    }

    public function edit(PizzaEdge $pizzaEdge)
    {
        return view('admin.pizza-edges.edit', compact('pizzaEdge'));
    }

    public function update(UpdatePizzaEdgeRequest $request, PizzaEdge $pizzaEdge)
    {
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }
        $currentImage = $pizzaEdge->image; // Lưu giá trị ảnh hiện tại

        $pizzaEdge->update($data);

        // Xóa ảnh cũ nếu cần
        if ($request->hasFile('image') && $currentImage && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }

        return back()
            ->with('success', 'Sửa thành công');
    }

    public function destroy(PizzaEdge $pizzaEdge)
    {
        // Xóa ảnh nếu tồn tại
        if ($pizzaEdge->image && Storage::exists($pizzaEdge->image)) {
            Storage::delete($pizzaEdge->image);
        }

        $pizzaEdge->delete();

        return redirect()
            ->route('admin.pizza-edges.index')
            ->with('success', 'Xóa thành công');
    }
}
