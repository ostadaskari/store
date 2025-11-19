<ul class="">
    @foreach ($categories as $category)
        <li class="">
            <a class=""
               href="{{ route('category.show', $category->slug) }}">
                {{ $category->name }}

            </a>

            @if ($category->childrenRecursive->count())
                @include('front.partials.category_menu', ['categories' => $category->childrenRecursive])
            @endif
        </li>
    @endforeach
</ul>
