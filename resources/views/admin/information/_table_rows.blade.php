<table class="table table-hover table-striped align-middle mb-0 text-center" dir="rtl">
    <thead class="table-blue">
    <tr>
        <th style="width: 3%;">#</th>
        <th style="width: 12%;">Part Number</th>
        <th style="width: 20%;"> Title</th>
        <th style="width: 30%;"> Description</th>

        <th style="width: 10%;">عملیات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($products as $i => $product)
        @php
            $information = $product->information;
            $incomplete = !($information && trim($information->title) !== '' && trim($information->description) !== '' );
        @endphp
        <tr data-part="{{ $product->part_number }}" class="{{ $incomplete ? 'metaFontBg' : '' }}">
            <td>{{ ($products->currentPage()-1)*$products->perPage() + $loop->iteration }}</td>
            <td><strong class="{{ $incomplete ? 'metaFontcolor' : '' }}">{{ $product->part_number }}</strong></td>

            <td><input type="text" name="title" class="form-control table-input" value="{{ $information->title ?? '' }}"></td>
            <td><textarea name="description" class="form-control table-input" rows="3">{{ $information->description ?? '' }}</textarea></td>


            <td style="white-space:nowrap;">
                <button class="btn btn-sm btn-success save-information">
                    <svg  viewBox="0 0 24 24" fill="currentColor"
                         width="16" height="16" style="vertical-align: middle; margin-left: 4px;">
                        <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.41l-2.34-2.34a1.003 1.003 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                    </svg>
                    ذخیره
                </button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
