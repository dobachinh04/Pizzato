<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePizzaBaseRequest;
use App\Http\Requests\UpdatePizzaBaseRequest;
use App\Models\PizzaBase;
use Illuminate\Support\Facades\Storage;

class PizzaBaseController extends Controller
{
    const PATH_UPLOAD = 'products/pizza-bases';

    public function index()
    {
        $pizzaBases = PizzaBase::query()->latest('id')->get();
        return view('admin.pizza-bases.index', compact('pizzaBases'));
    }

    public function create()
    {
        return view('admin.pizza-bases.create');
    }

    public function store(StorePizzaBaseRequest $request)
    {
        // Xử lý ảnh
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        PizzaBase::query()->create($data);

        return redirect()
            ->route('admin.pizza-bases.index')
            ->with('success', 'Thêm thành công');
    }

    public function edit(PizzaBase $pizzaBase)
    {
        return view('admin.pizza-bases.edit', compact('pizzaBase'));
    }

    public function update(UpdatePizzaBaseRequest $request, PizzaBase $pizzaBase)
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $data['image'] = Storage::put(self::PATH_UPLOAD, $request->file('image'));
        }

        $currentImage = $pizzaBase->image;

        $pizzaBase->update($data);

        if ($request->hasFile('image') && $currentImage && Storage::exists($currentImage)) {
            Storage::delete($currentImage);
        }

        return back()
            ->with('success', 'Sửa thành công');
    }

    public function destroy(PizzaBase $pizzaBase)
    {
        if ($pizzaBase->image && Storage::exists($pizzaBase->image)) {
            Storage::delete($pizzaBase->image);
        }

        $pizzaBase->delete();

        return redirect()
            ->route('admin.pizza-bases.index')
            ->with('success', 'Xóa thành công');
    }
}
