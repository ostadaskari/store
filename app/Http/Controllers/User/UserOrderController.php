<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrderController extends Controller
{
    // Define the number of items per page for non-ajax load
    protected const PER_PAGE = 10;
        public function orders(Request $request)
    {
        $data['header_title'] = 'سفارشات کاربر';
        $userId = Auth::id();

        // Separate logic for simple counts and main query

        $data['user_orders_complete'] = Order::where('user_id', $userId)->where('status', 'completed')->get();
        $data['user_orders_complete_count'] = $data['user_orders_complete']->count();
        $data['user_orders_canceled'] = Order::where('user_id', $userId)->where('status', 'canceled')->get();
        $data['user_orders_canceled_count'] = $data['user_orders_canceled']->count();

        // Base query with necessary relationships for list and details
        $query = Order::with(['items.product.coverImage', 'shipping', 'address'])
            ->where('user_id', $userId)
            ->latest();

        // 🔍 AJAX Handling
        if ($request->ajax()) {
            // Case 1: Fetch Order Details - (Keep this logic for your detail view)
            if ($request->filled('detail_id')) {
                // Ensure the user owns the order before returning details
                $order = $query->findOrFail($request->detail_id);
                // Assuming you have an 'order_details' partial for this
                return view('user.partials.order_details', compact('order'))->render();
            }

            // Case 2: AJAX Search for Orders - The primary AJAX action for the invoice panel
            $search = $request->input('search');
            if ($search) {
                // Apply search filter
                $query->where('order_number', 'LIKE', '%' . $search . '%');
            }

            // Add Pagination for AJAX requests too, to avoid massive lists
            // Get the current page from the request (Laravel will handle this automatically with paginate)
            $orders = $query->paginate(self::PER_PAGE);

            // Render the invoice list partial with pagination data
            // The partial must contain the list AND the pagination links
            return view('user.partials.invoice_list', ['user_orders' => $orders])->render();
        }

        // Standard Dashboard Load (Initial page load)
        $data['user_orders'] = $query->whereNotIn('status', ['completed', 'canceled'])->paginate(self::PER_PAGE);
        $data['orders_count'] = $data['user_orders']->total(); // Use total() for paginated collection

        return view('user.orders.index', $data);
    }

}
