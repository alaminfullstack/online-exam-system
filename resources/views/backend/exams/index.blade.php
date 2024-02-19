@extends('frontend.layouts.app')

@section('title')
    exam list
@endsection

@section('description')
    exam list
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header border-bottom border-2 ">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">Exam List</h3>
                        <a href="{{ route('admin.exams.create') }}" class="btn btn-primary">Create</a>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">

                            @foreach ($exams as $exam)
                                <div class="col-md-6 col-xl-3">
                                    <div class="block block-rounded shadow-sm ">
                                        <div class="block-header">
                                            <div class="flex-grow-1 text-muted fs-sm fw-semibold">
                                                {{ $exam->title }}
                                            </div>
                                            <div class="block-options">
                                                <div class="dropdown">
                                                    <button type="button" class="btn-block-option"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.questions.index') }}">
                                                            <i class="fa fa-fw fa-users me-1"></i> Question
                                                        </a>
                                                  
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.questions.index') }}">
                                                            <i class="fa fa-fw fa-users me-1"></i> Preview
                                                        </a>

                                                      
                                                        <div role="separator" class="dropdown-divider"></div>

                                                        <a class="dropdown-item" href="{{ route('admin.exams.edit', $exam->id) }}"
                                                            >
                                                            <i class="fa fa-fw fa-pencil-alt me-1"></i> Edit Exam
                                                        </a>

                                                        <a class="dropdown-item text-danger" data-bs-toggle="modal"
                                                            data-bs-target="#modal-default" onclick="delete_item('{{ route('admin.exams.destroy', $exam->id) }}')" href="javascript:void(0)"
                                                            >
                                                            <i class="fa fa-fw fa-trash me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="block-content pb-8 text-end bg-image"
                                            style="background-image: url({{ $exam->image != null ? asset($exam->image) : asset('assets/media/photos/photo10.jpg') }});">
                                            <span class="badge bg-primary fw-bold p-2 text-uppercase">
                                                {{ $exam->exam_type }}
                                            </span>

                                            @if ($exam->status)
                                                <span class="badge bg-success fw-bold p-2 text-uppercase">
                                                    Publish
                                                </span>
                                            @else
                                                <span class="badge bg-danger fw-bold p-2 text-uppercase">
                                                    Pending
                                                </span>
                                            @endif


                                        </div>
                                        <div class="block-content">
                                            <p class="fs-sm fw-medium text-muted mt-1">
                                                Duration &middot; {{ $exam->duration }} min
                                            </p>
                                        </div>
                                        <div class="block-content block-content-full bg-body-light">
                                            <div class="row g-0 fs-sm text-center">
                                                <div class="col-6">
                                                    <a class="text-muted fw-semibold" href="javascript:void(0)">
                                                        Total: <b> {{ $exam->total_mark }} </b> mark
                                                    </a>
                                                </div>
                                                <div class="col-6">
                                                    <a class="text-muted fw-semibold" href="javascript:void(0)">
                                                        Pass : <b>{{ $exam->pass_mark }}</b> mark
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
        </div>
    </div>

    <div class="modal fadee" id="modal-default" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideup  modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Exam</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="delete_form" enctype="multipart/form-data">
                        @csrf
                        @method('delete')

                        <p class="fs-base mb-0"> Are you sure you want to delete this Exam? </p>
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
