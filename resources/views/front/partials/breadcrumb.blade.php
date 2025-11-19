<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-light p-2 rounded">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">خانه</a></li>
        @foreach ($breadcrumbs as $crumb)
            @if ($loop->last)
                <li class="breadcrumb-item active" aria-current="page">{{ $crumb->name }}</li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ route('category.show', $crumb->slug) }}">{{ $crumb->name }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
