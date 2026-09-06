<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Information;
use App\Models\Warehouse\Category;
use App\Models\Warehouse\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Full search page
     */
    public function index(Request $request)
    {
        $q = trim($request->get('q', ''));

        $products = collect();
        $categories = collect();
        $information = collect();

        if ($q !== '') {

            /*
             * ---------------------------------------------------------
             * 1. Search categories
             * ---------------------------------------------------------
             *
             * Categories are stored in the warehouse database.
             */
            $categories = Category::query()
                ->where(function ($query) use ($q) {
                    $query->where('name', 'LIKE', "%{$q}%")
                        ->orWhere('slug', 'LIKE', "%{$q}%");
                })
                ->orderByRaw(
                    "CASE
                        WHEN name = ? THEN 1
                        WHEN name LIKE ? THEN 2
                        WHEN name LIKE ? THEN 3
                        ELSE 4
                    END",
                    [
                        $q,
                        "{$q}%",
                        "%{$q}%"
                    ]
                )
                ->limit(20)
                ->get();


            /*
             * ---------------------------------------------------------
             * 2. Search information
             * ---------------------------------------------------------
             *
             * Information is stored in the main Laravel database.
             *
             * Because Information and Product use different
             * database connections, we search them separately.
             */
            $information = Information::query()
                ->where(function ($query) use ($q) {
                    $query->where('title', 'LIKE', "%{$q}%")
                        ->orWhere('product_part_number', 'LIKE', "%{$q}%");
                })
                ->orderByRaw(
                    "CASE
                        WHEN product_part_number = ? THEN 1
                        WHEN product_part_number LIKE ? THEN 2
                        WHEN title LIKE ? THEN 3
                        ELSE 4
                    END",
                    [
                        $q,
                        "{$q}%",
                        "%{$q}%"
                    ]
                )
                ->limit(50)
                ->get([
                    'id',
                    'product_part_number',
                    'title',
                    'description',
                ]);


            /*
             * Get product part numbers connected to information results.
             */
            $informationPartNumbers = $information
                ->pluck('product_part_number')
                ->filter()
                ->unique()
                ->values()
                ->toArray();


            /*
             * ---------------------------------------------------------
             * 3. Search products
             * ---------------------------------------------------------
             *
             * IMPORTANT:
             * products table DOES NOT have a "name" column.
             *
             * Therefore we only search using:
             *
             * - part_number
             * - information-linked part numbers
             */
            $products = Product::query()
                ->with([
                    'category',
                    'coverImage',
                ])
                ->where(function ($query) use ($q, $informationPartNumbers) {

                    /*
                     * Exact part number
                     */
                    $query->where('part_number', $q)

                        /*
                         * Part number starts with query
                         */
                        ->orWhere('part_number', 'LIKE', "{$q}%")

                        /*
                         * Part number contains query
                         */
                        ->orWhere('part_number', 'LIKE', "%{$q}%");


                    /*
                     * Products whose part number exists in
                     * information.product_part_number
                     */
                    if (!empty($informationPartNumbers)) {
                        $query->orWhereIn(
                            'part_number',
                            $informationPartNumbers
                        );
                    }
                })
                ->orderByRaw(
                    "CASE
                        WHEN part_number = ? THEN 1
                        WHEN part_number LIKE ? THEN 2
                        WHEN part_number LIKE ? THEN 3
                        ELSE 4
                    END",
                    [
                        $q,
                        "{$q}%",
                        "%{$q}%"
                    ]
                )
                ->paginate(12)
                ->withQueryString();
        }


        return view('front.search.index', compact(
            'q',
            'products',
            'categories',
            'information'
        ));
    }


    /**
     * AJAX search suggestions
     */
    public function suggestions(Request $request)
    {
        $q = trim($request->get('q', ''));


        /*
         * ---------------------------------------------------------
         * Minimum query length
         * ---------------------------------------------------------
         */
        if (mb_strlen($q) < 2) {
            return response()->json([
                'products' => [],
                'categories' => [],
                'information' => [],
                'search_url' => route('search', [
                    'q' => $q,
                ]),
            ]);
        }


        /*
         * ---------------------------------------------------------
         * 1. Categories
         * ---------------------------------------------------------
         */
        $categories = Category::query()
            ->where(function ($query) use ($q) {

                $query->where('name', 'LIKE', "%{$q}%")
                    ->orWhere('slug', 'LIKE', "%{$q}%");

            })
            ->orderByRaw(
                "CASE
                WHEN name = ? THEN 1
                WHEN name LIKE ? THEN 2
                WHEN name LIKE ? THEN 3
                ELSE 4
            END",
                [
                    $q,
                    "{$q}%",
                    "%{$q}%"
                ]
            )
            ->limit(5)
            ->get([
                'id',
                'name',
                'slug',
                'parent_id',
            ]);


        /*
         * ---------------------------------------------------------
         * 2. Information
         * ---------------------------------------------------------
         *
         * Information is stored in the main Laravel database.
         */
        $information = Information::query()
            ->where(function ($query) use ($q) {

                $query->where('title', 'LIKE', "%{$q}%")
                    ->orWhere(
                        'product_part_number',
                        'LIKE',
                        "%{$q}%"
                    );

            })
            ->orderByRaw(
                "CASE
                WHEN product_part_number = ? THEN 1
                WHEN product_part_number LIKE ? THEN 2
                WHEN title LIKE ? THEN 3
                ELSE 4
            END",
                [
                    $q,
                    "{$q}%",
                    "%{$q}%"
                ]
            )
            ->limit(10)
            ->get([
                'id',
                'product_part_number',
                'title',
            ]);


        /*
         * ---------------------------------------------------------
         * Extract product part numbers from Information
         * ---------------------------------------------------------
         */
        $informationPartNumbers = $information
            ->pluck('product_part_number')
            ->filter()
            ->unique()
            ->values()
            ->toArray();


        /*
         * ---------------------------------------------------------
         * 3. Products
         * ---------------------------------------------------------
         *
         * IMPORTANT:
         *
         * products table DOES NOT have a "name" column.
         *
         * We search only by:
         *
         * - part_number
         * - Information linked part numbers
         */
        $products = Product::query()
            ->with([
                'category',
                'coverImage',
            ])
            ->where(function ($query) use ($q, $informationPartNumbers) {

                /*
                 * Exact part number
                 */
                $query->where('part_number', $q)

                    /*
                     * Part number starts with query
                     */
                    ->orWhere(
                        'part_number',
                        'LIKE',
                        "{$q}%"
                    )

                    /*
                     * Part number contains query
                     */
                    ->orWhere(
                        'part_number',
                        'LIKE',
                        "%{$q}%"
                    );


                /*
                 * Products connected to Information
                 */
                if (!empty($informationPartNumbers)) {

                    $query->orWhereIn(
                        'part_number',
                        $informationPartNumbers
                    );

                }

            })
            ->orderByRaw(
                "CASE
                WHEN part_number = ? THEN 1
                WHEN part_number LIKE ? THEN 2
                WHEN part_number LIKE ? THEN 3
                ELSE 4
            END",
                [
                    $q,
                    "{$q}%",
                    "%{$q}%"
                ]
            )
            ->limit(8)
            ->get();


        /*
         * ---------------------------------------------------------
         * 4. Get Information for the returned Products
         * ---------------------------------------------------------
         *
         * We cannot use:
         *
         * ->with('information')
         *
         * because Product and Information use different
         * database connections.
         */
        $productPartNumbers = $products
            ->pluck('part_number')
            ->filter()
            ->unique()
            ->values();


        $productInformation = Information::query()
            ->whereIn(
                'product_part_number',
                $productPartNumbers
            )
            ->get([
                'product_part_number',
                'title',
            ])
            ->keyBy('product_part_number');


        /*
         * ---------------------------------------------------------
         * 5. Return JSON
         * ---------------------------------------------------------
         */
        return response()->json([

            /*
             * =====================================================
             * Products
             * =====================================================
             */
            'products' => $products->map(
                function ($product) use ($productInformation) {

                    /*
                     * Find Information belonging to this product.
                     */
                    $info = $productInformation->get(
                        $product->part_number
                    );


                    return [

                        'id' => $product->id,


                        /*
                         * Product Part Number
                         */
                        'part_number' => $product->part_number,


                        /*
                         * Manufacturer
                         */
                        'mfg' => $product->mfg,


                        /*
                         * Product slug
                         */
                        'slug' => $product->slug,


                        /*
                         * Information title
                         *
                         * This is the same title used by
                         * product-card.blade.php.
                         */
                        'information_title' => $info?->title,


                        /*
                         * Product image
                         *
                         * IMPORTANT:
                         *
                         * Use the same URL accessor as
                         * product-card.blade.php:
                         *
                         * $product->coverImage->url
                         */
                        'image' => $product->coverImage
                            ? $product->coverImage->url
                            : null,


                        /*
                         * Product URL
                         */
                        'url' => $product->category
                            ? route('front.product.show', [
                                'category' =>
                                    $product->category->slug,

                                'product' =>
                                    $product->slug,
                            ])
                            : null,
                    ];
                }
            ),


            /*
             * =====================================================
             * Categories
             * =====================================================
             */
            'categories' => $categories->map(
                function ($category) {

                    return [

                        'id' => $category->id,

                        'name' => $category->name,

                        'slug' => $category->slug,

                        'url' => route(
                            'category.show',
                            [
                                'slug' => $category->slug,
                            ]
                        ),
                    ];
                }
            ),


            /*
             * =====================================================
             * Information
             * =====================================================
             */
            'information' => $information->map(
                function ($item) {

                    return [

                        'id' => $item->id,

                        'part_number' =>
                            $item->product_part_number,

                        'title' => $item->title,
                    ];
                }
            ),


            /*
             * =====================================================
             * Full Search URL
             * =====================================================
             */
            'search_url' => route(
                'search',
                [
                    'q' => $q,
                ]
            ),
        ]);
    }
}
