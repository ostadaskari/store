<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;
use Illuminate\Validation\Rule;

class DiscountController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q', '');
        $discounts = Discount::where('is_deleted', false)
            ->when($q, fn($qB) => $qB->where('name', 'like', "%{$q}%")->orWhere('code', 'like', "%{$q}%"))
            ->orderByDesc('created_at')
            ->paginate(25);

        return view('admin.discounts.index', compact('discounts', 'q'));
    }

    public function create()
    {
        return view('admin.discounts.form', ['discount' => new Discount()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'code' => 'required|string|max:64|unique:discounts,code',
            'type' => ['required', Rule::in(['percent', 'amount'])],
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'start_at' => 'nullable|date',
            'expire_at' => 'nullable|date|after_or_equal:start_at',
            'status' => 'nullable|boolean',
            'max_uses' => 'nullable|integer|min:1',
            'per_user_limit' => 'nullable|integer|min:1',
            'applicable_products' => 'nullable|array',
            'applicable_categories' => 'nullable|array',
            'stackable' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);

        // store arrays as json
        if (!empty($data['applicable_products'])) {
            // sanitize part numbers (trim)
            $data['applicable_products'] = array_values(array_filter(array_map('trim', $data['applicable_products'])));
        }
        if (!empty($data['applicable_categories'])) {
            $data['applicable_categories'] = array_values(array_map('intval', $data['applicable_categories']));
        }

        $data['status'] = $request->has('status') ? (bool)$request->status : true;
        $data['stackable'] = $request->has('stackable') ? (bool)$request->stackable : false;
        $data['created_by'] = auth()->id();

        Discount::create($data);

        return redirect()->route('admin.discounts.index')->with('success', 'کپن با موفقیت ایجاد شد.');
    }

    public function edit(Discount $discount)
    {
        return view('admin.discounts.form', compact('discount'));
    }

    public function update(Request $request, Discount $discount)
    {
        $data = $request->validate([
            'name' => 'required|string|max:191',
            'code' => ['required', 'string', 'max:64', Rule::unique('discounts', 'code')->ignore($discount->id)],
            'type' => ['required', Rule::in(['percent', 'amount'])],
            'value' => 'required|numeric|min:0',
            'min_order_amount' => 'nullable|numeric|min:0',
            'start_at' => 'nullable|date',
            'expire_at' => 'nullable|date|after_or_equal:start_at',
            'status' => 'nullable|boolean',
            'max_uses' => 'nullable|integer|min:1',
            'per_user_limit' => 'nullable|integer|min:1',
            'applicable_products' => 'nullable|array',
            'applicable_categories' => 'nullable|array',
            'stackable' => 'nullable|boolean',
            'description' => 'nullable|string',
        ]);

        // Normalize arrays
        if (!empty($data['applicable_products'])) {
            $data['applicable_products'] = array_values(array_filter(array_map('trim', $data['applicable_products'])));
        }

        if (!empty($data['applicable_categories'])) {
            $data['applicable_categories'] = array_values(array_map('intval', $data['applicable_categories']));
        }

        // Normalize booleans
        $data['status'] = $request->has('status') ? (bool)$request->status : true;
        $data['stackable'] = $request->has('stackable') ? (bool)$request->stackable : false;

        $discount->update($data);

        return redirect()->route('admin.discounts.index')->with('success', 'ویرایش با موفقیت انجام شد.');
    }


    public function destroy(Discount $discount)
    {
        // soft-like delete
        $discount->update(['is_deleted' => true]);
        return redirect()->route('admin.discounts.index')->with('success', 'کپن حذف شد.');
    }


    public function ajaxSearch(Request $request)
    {
        $q = $request->get('q', '');

        if (strlen($q) < 2) {
            return response()->json(['html' => '']); // no results for <2 chars
        }

        $discounts = Discount::where('is_deleted', false)
            ->where(function($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                    ->orWhere('code', 'like', "%{$q}%");
            })
            ->orderByDesc('created_at')
            ->get();

        $html = view('admin.discounts.partials.table_rows', compact('discounts'))->render();

        return response()->json(['html' => $html]);
    }

}
