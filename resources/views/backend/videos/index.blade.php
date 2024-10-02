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
                <li class="breadcrumb-item active" aria-current="page">Videos List</li>
            </ol>
        </nav>
        <div class=" ms-auto">
            <a href="{{ route('admin.videos.create') }}" class="btn btn-primary btn-sm btn-icon">
                <i class="bi bi-plus"></i> Add New Video </a>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">
                <table class="table mb-0" id="">
                    <thead>
                        <tr>
                            <th>Sl No.</th>
                            <th>Video Link</th>
                            <th>Name</th>
                            <th>Serial</th>
                            <th>Publish</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $videos as $key=>$item)
                        <tr>
                            <td>{{  $videos->firstItem() + $key  }}</td>
                            <td>

                                @php
                                        $video_id = explode("?v=", $item->video);
                                        $video_id = $video_id[1];
                                        $thumbnail="http://img.youtube.com/vi/".$video_id."/maxresdefault.jpg";
                                @endphp
                                <a href="{{ $item->video }}" target="_new">
                                    <img src="{{ $thumbnail }}" alt="" width="200px" style="border-radius: 10px"></td>

                                </a>
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
                                            <a href="{{url('admin/videos/'.$item->id.'/edit')}}" class="dropdown-item">Edit</a>
                                            <a href="javascript:void(0)" data="{{$item->id}}" class="dropdown-item delete-video">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6"> No Videos are added </td>
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
                    url: "{{ route('admin.videos.change-status') }}",
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

            $('body').on('click', '.delete-video', function() {
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
                            url: "videos/" + id,
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
