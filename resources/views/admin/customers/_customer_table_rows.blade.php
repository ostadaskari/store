@forelse($getRecord as $value)
    <tr class="align-middle">
        {{-- Row numbering adjusted for pagination --}}
        <td>{{ $loop->iteration + ($getRecord->currentPage() - 1) * $getRecord->perPage() }}</td>
        <td>{{ $value->name }} {{ $value->family }}</td>
        <td>{{ $value->email }}</td>
        <td>
            @if($value->status == 0)
                <span class="badge bg-success">فعال</span>
            @else
                <span class="badge bg-danger">غیرفعال</span>
            @endif
        </td>
        <td>{{ jdate($value->created_at)->format('Y/m/d H:i') }}</td>
        <td class="d-flex flex-row justify-content-center gap-2">
            <a href="{{ route('admin.customers.addresses', $value->id) }}" class="btn btn-sm btn-info text-white" title="مشاهده آدرس‌ها">آدرس‌ها</a>

            {{-- Assuming 'admin.customers.delete' route is defined --}}
            <a href="{{ route('admin.customers.delete', $value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('آیا مطمئن هستید که می‌خواهید این مشتری را حذف کنید؟')" title="حذف مشتری">حذف</a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center py-4">
            هیچ مشتری‌ای با این مشخصات یافت نشد.
        </td>
    </tr>
@endforelse
