@extends('admin.layouts.app')

@section('content')
    <h3>Categories (flat table)</h3>

    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @foreach($flat as $index => $cat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td style="padding-right: {{ $cat->depth * 20 }}px">
                    {{-- optional icon for expand --}}
                    @if($cat->depth > 0) &nbsp;↳ &nbsp;@endif
                    {{ $cat->name }}
                </td>
                <td>{{ $cat->parent ? $cat->parent->name : '-' }}</td>
                <td>{{ $cat->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
