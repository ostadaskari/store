<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse\Category;

use PhpOffice\PhpSpreadsheet\Calculation\Category as ExcelCategory;

class CategoryController extends Controller
{
    public function index()
    {

        // load only root categories, eager-load recursive children
        $data['header_title'] = 'Category List';
        $data['roots'] = Category::whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('name')
            ->get();

        return view('admin.category.list', $data);
    }

    // Optional: create a flattened list with depth for table output
    public function indexFlat()
    {
        $roots = Category::whereNull('parent_id')
            ->with('childrenRecursive','parent')
            ->orderBy('name')
            ->get();

        $flat = [];
        $this->buildTree($roots, 0, $flat);

        return view('admin.category.flat', ['flat' => $flat]);
    }

    // helper to flatten recursive collection and set depth
    protected function buildTree($nodes, $level = 0, array &$result = [])
    {
        foreach ($nodes as $node) {
            $node->depth = $level;
            $result[] = $node;
            if ($node->children && $node->children->count()) {
                $this->buildTree($node->children, $level + 1, $result);
            }
        }
        return $result;
    }
}
