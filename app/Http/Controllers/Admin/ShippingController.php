<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShippingController extends Controller
{
    // index shows list + form. If ?edit=ID passed, we populate $editing
    public function index(Request $request)
    {
        $header_title = "باربری";
        $q = $request->get('q', '');
        $shippings = Shipping::visible()
            ->when($q, fn($b) => $b->where('name','like',"%{$q}%")->orWhere('slug','like',"%{$q}%"))
            ->orderBy('sort_order')
            ->paginate(25);

        $editing = null;
        if ($request->has('edit')) {
            $editing = Shipping::visible()->find($request->get('edit'));
        }

        return view('admin.shippings.index', compact('shippings', 'q', 'editing', 'header_title'));
    }

    // store new
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:shippings,slug',
            'price' => 'required|numeric|min:0',
            'delivery_time' => 'nullable|string|max:191',
            'min_weight' => 'nullable|numeric|min:0',
            'max_weight' => 'nullable|numeric|min:0',

            'sort_order' => 'nullable|integer',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);

        $data['status'] = $request->boolean('status');
        $data['created_by'] = auth()->id();

        Shipping::create($data);

        return redirect()->route('admin.shippings.index')->with('success','روش ارسال ایجاد شد.');
    }

    // update existing
    public function update(Request $request, Shipping $shipping)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'slug' => 'nullable|string|max:191|unique:shippings,slug,'.$shipping->id,
            'price' => 'required|numeric|min:0',
            'delivery_time' => 'nullable|string|max:191',
            'min_weight' => 'nullable|numeric|min:0',
            'max_weight' => 'nullable|numeric|min:0',

            'sort_order' => 'nullable|integer',
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['status'] = $request->boolean('status');

        $shipping->update($data);

        return redirect()->route('admin.shippings.index')->with('success','روش ارسال بروزرسانی شد.');
    }

    // soft delete
    public function destroy(Shipping $shipping)
    {
        $shipping->update(['is_deleted' => true]);
        return redirect()->route('admin.shippings.index')->with('success','روش ارسال حذف شد.');
    }

    // toggle status (ajax or post)
    public function toggleStatus(Shipping $shipping)
    {
        $shipping->update(['status' => !$shipping->status]);
        return response()->json(['status' => 'ok', 'new' => $shipping->status]);
    }
}
