@extends('frontend.layouts.app')

@section('title')
    question Create
@endsection

@section('description')
    question Create
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header border-bottom border-2">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">Question Create</h3>
                        <a href="{{ route('admin.questions.index', ['exam_id' => $exam_id]) }}" class="btn btn-primary">List</a>
                    </div>
                    <div class="block-content block-content-full">
                        <form method="POST" action="{{ route('admin.questions.store') }}" enctype="multipart/form-data">
                            @csrf
                            @if ($errors->any())
                                <div class="mb-3">
                                    <div class="">
                                        @foreach ($errors->all() as $error)
                                            <strong class="d-block text-danger">{{ $error }}</strong>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <input type="hidden" name="exam_id" value="{{ $exam_id }}" />

                            <div class="row">
                                <div class="col-12 mb-4">
                                    <label class="form-label">Question</label>
                                    <textarea class="form-control summernote" id="js-ckeditor" rows="2" name="question_title"></textarea>
                                </div>


                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Option 1</label>
                                    <input type="text" class="form-control" name="option_1" value="">
                                </div>

                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Option 2</label>
                                    <input type="text" class="form-control" name="option_2" value="">
                                </div>

                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Option 3</label>
                                    <input type="text" class="form-control" name="option_3" value="">
                                </div>

                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Option 4</label>
                                    <input type="text" class="form-control" name="option_4" value="">
                                </div>

                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Correct Option</label>
                                    <select name="correct_option" class="form-control">
                                        <option value="option_1">option_1</option>
                                        <option value="option_2">option_2</option>
                                        <option value="option_3">option_3</option>
                                        <option value="option_4">option_4</option>
                                    </select>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
        </div>
    </div>
@endsection

@push('script')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" integrity="sha512-VCEWnpOl7PIhbYMcb64pqGZYez41C2uws/M/mDdGPy+vtEJHd9BqbShE4/VNnnZdr7YCPOjd+CBmYca/7WWWCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@1/dist/tinymce-jquery.min.js"></script> --}}
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        // $('#js-ckeditor').tinymce({
        //     height: 500,
        //     menubar: false,
        //     plugins: [
        //         'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
        //         'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
        //         'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
        //         'wordcount'
        //     ],
        //     toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
        // });
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endpush
