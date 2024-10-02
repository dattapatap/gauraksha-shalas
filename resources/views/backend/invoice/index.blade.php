@extends('backend.layouts.app')
@section('content')
    <div class="mb-4 d-flex">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/home') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Orders / Declined</li>
            </ol>
        </nav>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>





    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">
            </div>

        </div>
    </div>
@endsection


@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ route('admin.products.change-status') }}",
                    method: 'GET',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message)
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

        })
    </script>
@endpush
