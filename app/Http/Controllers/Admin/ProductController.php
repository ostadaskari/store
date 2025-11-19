<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse\Product;

class ProductController extends Controller
{
    public function index()
    {
        $data['header_title'] = 'Product List';
        $data['products'] = Product::with(['category.parent','lots'])->paginate(4);
        // only 1-level eager load, recursion will handle the rest

        return view('admin.product.list', $data);
    }
}
