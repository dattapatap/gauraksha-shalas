@extends('backend.layouts.app')

@section('styles')
<style>
    .table td {
    vertical-align: middle;
    white-space: normal;
}
</style>
@endsection

@section('content')
    <div class="mb-4 d-flex">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Blogs</li>
            </ol>
        </nav>
        <div class=" ms-auto">
            <a href="{{route('admin.blogs.create')}}" class="btn btn-primary btn-sm btn-icon">
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


@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}


<script>
    $(document).ready(function(){
        $('body').on('click', '.change-status', function(){
            let isChecked = $(this).is(':checked');
            let id = $(this).attr('id');
            $.ajax({
                url: "{{ route('admin.blogs.change-status')}}",
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


        $('body').on('click', '.delete-blog', function() {
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
                        url: "blogs/"+ id,
                        type: 'DELETE',
                        data: {_token: '{{csrf_token()}}' },
                        success: function(data){
                            if(data.status == 'error'){
                                toastr.error(data.message)
                            }else{
                                toastr.success(data.message)
                                setTimeout(() => {
                                    location.reload()
                                }, 2000);
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

@endpush
