<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInvoiceController extends Controller
{
    /**
     * Display a listing of the user's invoices.
     * This is the main view function (route('user.invoices')).
     */
    public function index(Request $request)
    {
        $userId = Auth::id();

        // --- Data for Current Invoices (Initial Load) ---
        // Base query for current invoices (paginated)
        $invoices = Order::where('user_id', $userId)
            ->whereNotIn('status', ['completed', 'canceled'])
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Paginate 10 items per page

        // --- Counts for all tabs ---
        $invoices_count = Order::where('user_id', $userId)->whereNotIn('status', ['completed', 'canceled'])->count();
        $user_invoices_complete_count = Order::where('user_id', $userId)->where('status', 'completed')->count();
        $user_invoices_canceled_count = Order::where('user_id', $userId)->where('status', 'canceled')->count();

        // Note: Removed initial data fetch for completed/canceled, as they will load via AJAX

        return view('user.invoices.index', compact(
            'invoices', // Initial current invoices
            'invoices_count',
            'user_invoices_complete_count',
            'user_invoices_canceled_count'
        ));
    }

    /**
     * Handle AJAX requests for searching and paginating invoices for any status type.
     */
    public function fetchInvoices(Request $request)
    {
        $userId = Auth::id();
        $statusType = $request->input('status', 'current'); // Get status, default to 'current'

        $query = Order::where('user_id', $userId)->orderBy('created_at', 'desc');

        // 1. Determine the status filter based on the statusType
        switch ($statusType) {
            case 'completed':
                $query->where('status', 'completed');
                $viewPartial = 'user.invoices.partials.completed_invoice_items';
                break;
            case 'canceled':
                $query->where('status', 'canceled');
                $viewPartial = 'user.invoices.partials.canceled_invoice_items';
                break;
            case 'current':
            default:
                $query->whereNotIn('status', ['completed', 'canceled']);
                $viewPartial = 'user.invoices.partials.current_invoice_items';
                break;
        }

        // 2. Apply search filter
        if ($search = $request->input('search')) {
            // Use a group for OR conditions to prevent breaking the main WHERE clause
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                    ->orWhere('total_amount', 'like', "%{$search}%");
                // Add other relevant search fields here if needed
            });
        }

        // 3. Paginate the results
        $invoices = $query->paginate(10, ['*'], 'page', $request->input('page'));

        // 4. Render the HTML and links
        $view = view($viewPartial, ['user_invoices' => $invoices])->render();

        return response()->json([
            'html' => $view,
            'links' => $invoices->links()->toHtml(),
            'count' => $invoices->total(),
        ]);
    }
}
