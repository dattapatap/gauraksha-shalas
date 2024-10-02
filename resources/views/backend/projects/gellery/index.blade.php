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
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/projects') }}"> Project List </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin/projects') }}"> {{ $project->name }} </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Images</li>
            </ol>
        </nav>
        <div class=" ms-auto">
            <a href="{{ route('admin.projects.gallery.create', $project->slug )}}" class="btn btn-primary btn-sm btn-icon">
                    <i class="bi bi-plus"></i>  Add New </a>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">

                <table class="table mb-0" id="">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Project</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $gallery as $key=>$item)
                            <tr>
                                <td> {{  $gallery->firstItem() + $key  }} </td>
                                <td>{{ $project->name  }}</td>
                                <td>
                                    <a target="_new" href="{{ asset('storage/'.$item->image ) }}">
                                        <img class="img" src="{{ asset('storage/'.$item->image ) }}" style="height:100px;border-radius: 10px;" >
                                    </a>
                                </td>
                                <td>
                                    <a href="javascript:void(0);" data="{{ $item->id }}" class="btn btn-round btn-sm btn-danger btn-dltVarient">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6"> No Images are added </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>


            </div>
        </div>
    </div>

@endsection


@push('scripts')

<script>
    $(document).ready(function(){
        $('body').on('click', '.btn-dltVarient', function(){
            let id = $(this).attr('data');

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
                        url: "{{ route('admin.projects.variants.delete') }}",
                        type: 'POST',
                        data: {_token: '{{csrf_token()}}', 'id' : id },
                        success: function(data){
                            toastr.success(data.message)
                            location.reload()
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
