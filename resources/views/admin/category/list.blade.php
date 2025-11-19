@extends('admin.layouts.app')

@section('style')
    <style>
        /* --- Category Tree Styling --- */
        .category-tree {
            list-style: none;
            padding-left: 0;
            font-family: "Segoe UI", sans-serif;
            font-size: 15px;
        }

        .category-node {
            margin: 4px 0;
        }

        .node-label {
            cursor: pointer;
            user-select: none;
            padding: 4px 8px;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }

        .node-label:hover {
            background-color: #242c50;
        }

        .toggle-icon {
            display: inline-block;
            transition: transform 0.2s ease;
            color: #555;
            font-size: 12px;
        }

        .category-node.open > .node-label .toggle-icon {
            transform: rotate(90deg);
        }

        .child-list {
            border-left: 1px dashed #ccc;
            margin-left: 12px;
            padding-left: 10px;
            transition: all 0.2s ease-in-out;
        }

        .node-name {
            color: #fff;
        }

        .empty-icon {
            opacity: 0.4;
        }
    </style>
@endsection

@section('content')
    <div class="content-section">
        <div class="card mb-4">
            <div class="card-header row justify-between-end">
                <h3 class="card-title col-sm-6">📂 لیست دسته‌ها</h3>
            </div>

            @include('admin.layouts._message')

            <div class="card-body p-3">
                <ul class="category-tree">
                    @foreach($roots as $root)
                        @include('admin.category._node', ['category' => $root, 'depth' => 0])
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelectorAll(".category-node > .node-label").forEach(label => {
                label.addEventListener("click", e => {
                    e.stopPropagation();
                    const li = label.parentElement;
                    const childList = li.querySelector(".child-list");
                    if (childList) {
                        childList.classList.toggle("d-none");
                        li.classList.toggle("open");
                    }
                });
            });
        });
    </script>
@endsection
