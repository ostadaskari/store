<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail; // <-- NEW
use App\Mail\OrderStatusUpdated;      // <-- NEW

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
        if ($request->filled('order_number')) {
            $ordersQuery->where('order_number', 'LIKE', '%' . $request->order_number . '%');
        }
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
                $q->where('users.name', 'LIKE', '%' . $request->user_name . '%')
                    ->orWhere('users.family', 'LIKE', '%' . $request->user_name . '%');
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
    /**
     * Handles AJAX request to update order status and send notification email.
     * * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'status' => 'required|string|in:pending,processing,delivered,completed,canceled',
        ]);

        try {
            // Find the order and eagerly load the user
            $order = Order::with('user')->findOrFail($request->order_id);
            $oldStatus = $order->status;
            $newStatus = $request->status;

            // Update the status in the database
            $order->status = $newStatus;
            $order->save();

            // Dispatch the email (wrapped in its own error handling for clean logging)
            $this->sendEmailNotification($order, $newStatus);

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'وضعیت سفارش با موفقیت به‌روزرسانی شد و ایمیل اطلاع‌رسانی ارسال گردید.',
                'status_code' => $newStatus
            ]);

        } catch (Exception $e) {
            // Log the error for internal debugging
            \Log::error('Order Status Update Error (Order ID: ' . $request->order_id . '): ' . $e->getMessage());

            // Check if status changed before the error happened (which is true in your case)
            $message = 'وضعیت سفارش با موفقیت به‌روزرسانی شد، اما خطایی در ارسال ایمیل رخ داد.';

            // Revert the status if it failed before saving (though not likely in this scenario)
            if (isset($order) && $order->isDirty('status')) {
                // If the status was saved, we notify the user about the email failure only.
                return response()->json([
                    'success' => true, // We return true because the DB update worked
                    'message' => $message . ' لطفا تنظیمات ایمیل را بررسی کنید.',
                    'status_code' => $newStatus // Return the new status
                ]);
            }

            // Fallback for general database error
            return response()->json([
                'success' => false,
                'message' => 'خطا در به‌روزرسانی وضعیت سفارش.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Helper to send the status update email.
     * @param Order $order
     * @param string $newStatus
     * @throws Exception
     */
    protected function sendEmailNotification(Order $order, string $newStatus): void
    {
        if ($order->user && $order->user->email) {
            // Add status text dynamically for the email view
            $order->status_text = $this->getStatusText($newStatus);
            Mail::to($order->user->email)->send(new OrderStatusUpdated($order));
        }
    }

    /**
     * Helper function to convert status slug to readable text.
     */
    protected function getStatusText(string $status): string
    {
        return match ($status) {
            'pending' => 'در انتظار پرداخت',
            'processing' => 'در حال پردازش',
            'delivered' => 'تحویل داده شده',
            'completed' => 'تکمیل شده',
            'canceled' => 'لغو شده',
            default => 'وضعیت نامشخص',
        };
    }
}
