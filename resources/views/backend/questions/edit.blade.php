@extends('frontend.layouts.app')

@section('title')
    question edit
@endsection

@section('description')
    question edit
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header border-bottom border-2">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">Question edit</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form method="POST" action="{{ route('admin.questions.update', $question->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            @if ($errors->any())
                                <div class="mb-3">
                                    <div class="">
                                        @foreach ($errors->all() as $error)
                                            <strong class="d-block text-danger">{{ $error }}</strong>
                                        @endforeach
                                    </div>
                                </div>
                            @endif


                            <input type="hidden" name="exam_id" value="{{ $question->exam_id }}" />

                            <div class="row">
                               
                                <div class="col-12 mb-4">
                                    <label class="form-label">Question</label>
                                    <input type="text" class="form-control" id="question_title" name="question_title"
                                        value="{{ $question->question_title }}">
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label">Options</label>
                                    <textarea class="form-control" rows="5" id="inputTextArea">{{ $question->option_1."\n"  }} {{ $question->option_2."\n" }} {{ $question->option_3."\n"  }} {{ $question->option_4 }} </textarea>
                                </div>


                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Option 1</label>
                                    <input type="text" class="form-control" id="option_1" name="option_1"
                                        value="{{ $question->option_1 }}">
                                </div>

                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Option 2</label>
                                    <input type="text" class="form-control" id="option_2" name="option_2"
                                        value="{{ $question->option_2 }}">
                                </div>

                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Option 3</label>
                                    <input type="text" class="form-control" id="option_3" name="option_3"
                                        value="{{ $question->option_3 }}">
                                </div>

                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Option 4</label>
                                    <input type="text" class="form-control" id="option_4" name="option_4"
                                        value="{{ $question->option_4 }}">
                                </div>

                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Correct Option</label>
                                    <select name="correct_option" class="form-control">
                                        <option value="option_1" @if ($question->correct_option == 'option_1') selected @endif>option_1
                                        </option>
                                        <option value="option_2" @if ($question->correct_option == 'option_2') selected @endif>option_2
                                        </option>
                                        <option value="option_3" @if ($question->correct_option == 'option_3') selected @endif>option_3
                                        </option>
                                        <option value="option_4" @if ($question->correct_option == 'option_4') selected @endif>option_4
                                        </option>
                                    </select>
                                </div>


                                <div class="col-12 mb-4">
                                    <label class="form-label">Note</label>
                                    <textarea class="form-control summernote" id="js-ckeditor" rows="2" name="note">
                                        {!! $question->note !!}
                                    </textarea>
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });

        $(document).on('input', '#inputTextArea', function() {
            const optionsText = $(this).val(); // Get textarea content
            const optionsArray = optionsText.split("\n"); // Split into lines

            // Handle each line based on your desired auto-filling behavior
            optionsArray.forEach((line, index) => {
                if (line.trim() !== "") { // Check for blank lines
                    
                    // Fill input fields based on your desired order/logic
                    if (index < 4) { // Adjust loop condition based on maximum allowed options
                        $("#option_" + (index + 1)).val(line.trim());
                    } else {
                        // Handle excess options (error message, ignore, etc.)
                    }
                }
            });
        });
    </script>
@endpush
