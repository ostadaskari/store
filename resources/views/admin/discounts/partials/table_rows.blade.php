@foreach($discounts as $d)
    <tr>
        <td>{{ $d->code }}</td>
        <td>{{ $d->name }}</td>
        <td>{{ $d->type }}</td>
        <td>{{ $d->value }}</td>
        <td>{{ $d->status ? 'فعال' : 'غیرفعال' }}</td>
        <td>{{ $d->expire_at?->format('Y-m-d') ?? '-' }}</td>
        <td>
            <a href="{{ route('admin.discounts.edit', $d) }}" class="btn btn-sm btn-primary">ویرایش</a>
            <form action="{{ route('admin.discounts.destroy', $d) }}" method="POST" style="display:inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('مطمئنید؟')">حذف</button>
            </form>
        </td>
    </tr>
@endforeach
