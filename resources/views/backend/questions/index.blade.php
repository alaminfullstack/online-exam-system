@extends('frontend.layouts.app')

@section('title')
    question list
@endsection

@section('description')
    question list
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">Question List</h3>
                        <a href="{{ route('admin.questions.create', ['exam_id' => $exam_id]) }}" class="btn btn-primary">Create</a>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
        </div>

        <div class="row">

            @foreach ($questions as $question)
            <div class="col-md-6 col-xl-3">
                <div class="block block-rounded">
                    <div class="block-header">
                        <div class="flex-grow-1 text-muted fs-md fw-bold">
                            Q.{{ $loop->iteration }} : {!! $question->question_title !!}
                        </div>
                        <div class="block-options">
                            <div class="dropdown">
                                <button type="button" class="btn-block-option" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item"
                                        href="{{ route('admin.questions.edit', $question->id) }}">
                                        <i class="fa fa-fw fa-pencil-alt me-1"></i> Edit
                                    </a>
                                    <div role="separator" class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" data-bs-toggle="modal"
                                        data-bs-target="#modal-default" onclick="delete_item('{{ route('admin.questions.destroy', $question->id) }}')" href="javascript:void(0)">
                                        <i class="fa fa-fw fa-trash me-1"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="block-content">
                        <p class="fs-sm fw-medium text-muted mt-1">
                            @if ($question->correct_option == 'option_1')
                                <i class="fa fa-fw fa-check-double me-1"></i>
                            @endif
                            {{ $question->option_1 }}
                        </p>
                        <p class="fs-sm fw-medium text-muted mt-1">
                            @if ($question->correct_option == 'option_2')
                                <i class="fa fa-fw fa-check-double me-1"></i>
                            @endif
                            {{ $question->option_2 }}
                        </p>
                        <p class="fs-sm fw-medium text-muted mt-1">
                            @if ($question->correct_option == 'option_3')
                                <i class="fa fa-fw fa-check-double me-1"></i>
                            @endif
                            {{ $question->option_3 }}
                        </p>
                        <p class="fs-sm fw-medium text-muted mt-1">
                            @if ($question->correct_option == 'option_4')
                                <i class="fa fa-fw fa-check-double me-1"></i>
                            @endif
                            {{ $question->option_4 }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="modal fadee" id="modal-default" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideup  modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Question</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="delete_form" enctype="multipart/form-data">
                        @csrf
                        @method('delete')

                        <p class="fs-base mb-0"> Are you sure you want to delete this Question? </p>
                        <div class="mt-2">
                            <button data-bs-dismiss="modal" type="button" aria-label="Close" type="button"
                                class="btn btn-secondary">Cancel</button>

                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        function delete_item(route) {
            $('#delete_form').attr('action', route);
        }
    </script>
@endpush
