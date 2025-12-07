<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(Request $request)
    {
        $header_title = "orders";

        // Start building the query on the Order model
        $ordersQuery = Order::with('user', 'address')
            ->orderBy('created_at', 'desc');

        // --- Apply Filters ---

        // 1. Filter on Orders Table fields (Direct)
        if ($request->filled('status')) {
            $ordersQuery->where('status', $request->status);
        }
        if ($request->filled('discount_code')) {
            $ordersQuery->where('discount_code', 'LIKE', '%' . $request->discount_code . '%');
        }
        if ($request->filled('payment_method')) {
            $ordersQuery->where('payment_method', $request->payment_method);
        }

        // 2. Date Range Filter
        if ($request->filled('from_date')) {
            $ordersQuery->whereDate('orders.created_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $ordersQuery->whereDate('orders.created_at', '<=', $request->to_date);
        }

        // 3. Filter on User Information (via JOIN for performance on multiple fields)
        $ordersQuery->join('users', 'orders.user_id', '=', 'users.id');

        // Use select to prevent column collision (e.g., id, created_at)
        $ordersQuery->select('orders.*');

        if ($request->filled('user_name')) {
            $ordersQuery->where(function ($q) use ($request) {
                $q->where('users.first_name', 'LIKE', '%' . $request->user_name . '%')
                    ->orWhere('users.last_name', 'LIKE', '%' . $request->user_name . '%');
            });
        }
        if ($request->filled('user_mobile')) {
            $ordersQuery->where('users.mobile', 'LIKE', '%' . $request->user_mobile . '%');
        }
        if ($request->filled('user_email')) {
            $ordersQuery->where('users.email', 'LIKE', '%' . $request->user_email . '%');
        }

        // 4. Filter on UserAddress Information (via JOIN on user_address_id)
        $addressFilters = [
            'address_first_name' => 'first_name',
            'address_last_name' => 'last_name',
            'address_mobile' => 'mobile',
            'address_phone' => 'phone',
            'address_province' => 'province',
            'address_city' => 'city',
            'address_address' => 'address',
            'address_post_code' => 'post_code',
            'address_company_name' => 'company_name',
        ];

        // Only join the user_addresses table if at least one address filter is present.
        $hasAddressFilter = false;
        foreach (array_keys($addressFilters) as $inputKey) {
            if ($request->filled($inputKey)) {
                $hasAddressFilter = true;
                break;
            }
        }

        if ($hasAddressFilter) {
            $ordersQuery->join('user_addresses', 'orders.user_address_id', '=', 'user_addresses.id');
            $ordersQuery->select('orders.*'); // Re-select to prioritize order columns

            foreach ($addressFilters as $inputKey => $column) {
                if ($request->filled($inputKey)) {
                    // Use LIKE for text fields, direct equality for province/city
                    $operator = in_array($column, ['province', 'city']) ? '=' : 'LIKE';
                    $value = ($operator === 'LIKE') ? '%' . $request->input($inputKey) . '%' : $request->input($inputKey);

                    $ordersQuery->where("user_addresses.{$column}", $operator, $value);
                }
            }
        }

        // Final execution
        $orders = $ordersQuery->paginate(15)->appends($request->except('page'));


        return view('admin.orders.list', compact('orders','header_title'));

    }
    /**
     * Display the details of a specific order.
     *
     * @param Order $order
     * @return \Illuminate\Contracts\View\View
     */
    public function show(Order $order)
    {
        // Eager load all necessary relationships for the detail view:
        // 1. user: The customer who placed the order.
        // 2. address: The selected delivery address (from user_addresses table).
        // 3. items: The products ordered (from order_items table).
        // 4. shipping: The shipping method used.

        $order->load('user', 'address', 'items.product', 'shipping');

        // Note: 'items.product' assumes that in your OrderItem model, you have a relationship
        // to retrieve product details (e.g., product name, image). Since products are in a
        // separate DB/connection, you might need a custom getter or service to hydrate this.
        // For this example, we assume `order_items` records contain enough denormalized data
        // (like product_id) or a service handles the hydration.

        // We will pass the full order object to the view.
        return view('admin.orders.show', compact('order'));
    }
}
