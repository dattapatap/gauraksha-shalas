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
                <li class="breadcrumb-item active" aria-current="page">Gallery Images</li>
            </ol>
        </nav>
        <div class=" ms-auto">
            <a href="{{ route('admin.images.create') }}" class="btn btn-primary btn-sm btn-icon">
                <i class="bi bi-plus"></i> Add New Image </a>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">
                <table class="table mb-0" id="">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Serial</th>
                            <th>Publish</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $images as $key=>$item)
                        <tr>
                            <td>{{  $images->firstItem() + $key  }}</td>
                            <td><img src="{{ asset('storage/'.$item->image) }}" alt=""
                                    width="80px"></td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->serial }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input change-status" type="checkbox" id="{{$item->id}}" @if ($item->status==true)
                                        checked
                                    @endif >
                                </div>
                            </td>
                            <td>
                                <div class="d-flex jc">
                                    <div class="dropdown">
                                        <a href="#" data-bs-toggle="dropdown" class="btn btn-floating"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="bi bi-three-dots"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a href="{{url('admin/images/'.$item->id.'/edit')}}" class="dropdown-item">Edit</a>
                                            <a href="javascript:void(0)" data="{{$item->id}}" class="dropdown-item delete-banner">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6"> No Banners are added </td>
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
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {
                let isChecked = $(this).is(':checked');
                let id = $(this).attr('id');
                $.ajax({
                    url: "{{ route('admin.images.change-status') }}",
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

            $('body').on('click', '.delete-banner', function() {
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
                            url: "images/" + id,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                toastr.success(data.message)
                                location.reload()
                            },
                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })
                    }
                })


            })
        })
    </script>
@endpush
