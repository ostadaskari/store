<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: "{{ session('success') }}",
            confirmButtonColor: '#3085d6'
        });
        @endif

        @if ($errors->any())
        Swal.fire({
            icon: 'error',
            title: 'Upload Failed',
            html: `
                <ul style="text-align: left;">
                    @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
                    @endforeach
            </ul>
`,
            confirmButtonColor: '#d33'
        });
        @endif
    });
</script>

