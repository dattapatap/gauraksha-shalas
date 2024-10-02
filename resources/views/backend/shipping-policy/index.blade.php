@extends('backend.layouts.app')
@section('content')
    <div class="mb-4">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ url('/admin') }}">
                        <i class="bi bi-globe2 small me-2"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Shipping Policy Page</li>
            </ol>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <form action="{{ route('admin.shippingpolicy.update', $content->id) }}" method="POST" onsubmit="validateForm()"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <textarea class="form-control @error('shipping') is-invalid @enderror" name="shipping" id="editor">{{ old('shipping', $content->content) }}</textarea>
                        @error('shipping')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('backend/assets/libs/ckeditor5/ckeditor.js') }}"></script>
    {{-- <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script> --}}
    <script>
        // ClassicEditor.create(document.querySelector('#editor'));

        var editor = ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: ['headings', 'bold', 'italic', 'link', 'bulletedList', 'numberedList'],
                heading: {
                    options: [
                        {modelElement: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph'},
                        {modelElement: 'heading1', viewElement: 'h1', title: 'Heading 1', class: 'ck-heading_heading1'},
                        {modelElement: 'heading2', viewElement: 'h2', title: 'Heading 2', class: 'ck-heading_heading2'},
                        {modelElement: 'heading', viewElement: 'h3', title: 'Heading 3', class: 'ck-heading_heading3'}
                    ]
                }
            })
            .then(function (editor) {
                console.log(Array.from(editor.ui.componentFactory.names()));
            });

        // function validateForm() {
        //     for (instance in ClassicEditor.instances) {
        //         ClassicEditor.instances[instance].updateElement();
        //     }
        // }
    </script>
@endpush
