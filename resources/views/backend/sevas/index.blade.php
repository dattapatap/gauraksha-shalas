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
                <li class="breadcrumb-item active" aria-current="page">Sevas</li>
            </ol>
        </nav>
        <div class=" ms-auto">
            <a href="{{ route('admin.sevas.create') }}" class="btn btn-primary btn-sm btn-icon">
                <i class="bi bi-plus"></i> Add New Seva </a>
        </div>
    </div>


    <div class="card">
        <div class="card-body">
            <div class="d-md-flex gap-4 align-items-center">
                <table class="table mb-0 table-striped ">
                    <thead>
                        <tr>
                            <th width="7%">Sl No.</th>
                            <th width="25%" style="text-align:left;">Project Name</th>
                            <th width="25%">Heading</th>
                            <th>Images</th>
                            <th>Seva Added</th>
                            <th>Publish</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ( $sevas as $key=>$item)
                        <tr>
                            <td> {{  $sevas->firstItem() + $key  }} </td>
                            <td style="text-align:left;">{{ $item->name }}</td>
                            <td> {{ $item->heading }} </td>
                            <td>
                                <a class="text-decoration-underline" href="{{ url('admin/sevas/'. $item->slug. '/gallery') }}">
                                    {{ $item->seva_images->count() }}
                                </a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                            <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input change-status" type="checkbox"
                                    id="{{ $item->id }}" @if ($item->status==true)   checked  @endif >
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
                                            <a href="{{url('admin/sevas/'.$item->id.'/edit')}}" class="dropdown-item">Edit</a>
                                            <a href="javascript:void(0)" data="{{$item->id}}" class="dropdown-item delete-seva">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7"> No Project are added </td>
                        </tr>

                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="cart-footer">
                <div class="row">
                    <div class="d-flex justify-content-end m-3">
                        {{ $sevas->links() }}
                    </div>

                </div>
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
                    url: "{{ route('admin.sevas.change-status') }}",
                    method: 'GET',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        if(data.status == false){
                            toastr.error(data.message)
                            $('.change-status').prop('checked', false)
                        }else{
                            toastr.success(data.message)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                })
            })

            $('body').on('click', '.delete-seva', function() {
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
                            url: "sevas/" + id,
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
