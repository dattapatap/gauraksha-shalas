@extends('backend.layouts.app')
@section('content')
    <div class="mb-4 d-flex">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Sub Categories</li>
            </ol>
        </nav>
        <div class=" ms-auto">
            <a href="{{route('admin.sub-category.create')}}" class="btn btn-primary btn-sm btn-icon">
                    <i class="bi bi-plus"></i>  Add New </a>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">
            </div>
            {{ $dataTable->table() }}
        </div>
    </div>

@endsection


@section('scripts')

{{ $dataTable->scripts(attributes: ['type' => 'module']) }}

<script>
    $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
            let isChecked = $(this).is(':checked');
            let id = $(this).attr('id');
            $.ajax({
                url: "{{ route('admin.sub-category.change-status')}}",
                method: 'GET',
                data: { status: isChecked, id: id    },
                success: function(data){
                    toastr.success(data.message)
                },
                error: function(xhr, status, error){
                    console.log(error);
                }
            })
        })







        $('body').on('click', '.delete-brand', function(){
            let id = $(this).attr('data');
            let row = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f48120',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "sub-category/"+ id,
                        type: 'DELETE',
                        data: {_token: '{{csrf_token()}}' },
                        success: function(data){
                            if(data.status == 'error'){
                                toastr.error(data.message)
                            }else{
                                toastr.success(data.message)
                                location.reload()
                            }
                        },
                        error: function(xhr, status, error){
                            console.log(error);
                        }
                    })
                }
            })

        })
    })
</script>

@endsection

