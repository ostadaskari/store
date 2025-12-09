<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CustomerController extends Controller
{
    public function list(Request $request)
    {
        $header_title = "customers";

        // 1. Prepare filters array (use all() to capture all necessary inputs, including page and ajax)
        // We ensure only the filter keys we need are extracted for the User model.
        $filters = $request->only(['name', 'email', 'mobile', 'status', 'from_date', 'to_date']);

        // 2. Fetch paginated customers using the model scope
        $query = User::getCustomer($filters);
        $getRecord = $query->paginate(15);

        // Append all request inputs (including filters and ajax flag) to pagination links
        $getRecord->appends($request->all());

        // 3. Handle AJAX requests
        if ($request->ajax() || $request->has('ajax')) { // Check both methods just in case
            // Render the table body and pagination links separately
            $tableRows = View::make('admin.customers._customer_table_rows', ['getRecord' => $getRecord])->render();
            $paginationLinks = $getRecord->links()->toHtml();

            return response()->json([
                'tableRows' => $tableRows,
                'paginationLinks' => $paginationLinks,
                'success' => true,
            ]);
        }

        // 4. Handle standard request (initial page load)
        return view('admin.customers.list', [
            'header_title' => $header_title,
            'getRecord' => $getRecord,
            'filters' => $filters // Pass filters back to view to keep form values
        ]);
    }

    /**
     * Show a list of addresses for a specific user/customer.
     * @param int $userId
     */
    public function showAddresses($userId)
    {
        $header_title = "customers-Addresses";
        // 1. Find the customer and load their addresses
        $customer = User::with('addresses')->findOrFail($userId);

        // 2. Return the view with the customer and their addresses
        return view('admin.customers.addresses', [
            'header_title' => $header_title,
            'customer' => $customer,
            'addresses' => $customer->addresses,
        ]);
    }

    public function delete($id){
        $user = User::getSingle($id);
        $user->is_delete = 1;
        $user->save();
        return redirect()->back()->with('success', 'customer deleted successfully');
    }
}
