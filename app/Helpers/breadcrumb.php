<?php

if (!function_exists('categoryBreadcrumb')) {
    function categoryBreadcrumb($category)
    {
        $items = [];

        $current = $category;
        while ($current) {
            $items[] = $current;
            $current = $current->parent;
        }

        return array_reverse($items);
    }
}

