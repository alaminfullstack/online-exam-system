@extends('frontend.layouts.app')

@section('title')
    examiner list
@endsection

@section('description')
    examiner list
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">
                            <b>Examiner List</b> 
                            @if($exam != null)
                            <small> Of  ({{ $exam->title ?? null }})</small>
                            @endif
                        </h3>

                        <a href="{{ route('admin.examiners.export', ['exam_id' => $exam->id ?? null]) }}" class="btn btn-sm btn-danger">Export Excel</a>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
        </div>

        <div class="row">

            @foreach ($examiners as $examiner)
                <div class="col-md-6 col-xl-4">
                    <div class="block block-rounded">
                        <div class="block-content block-content-full">
                            <div class="d-sm-flex">
                                <div class="py-2">
                                    <a class="link-fx h4 mb-1 d-inline-block text-dark text-capitalize " href="#">
                                        {{ $examiner->name }}
                                    </a>
                                    <div class="fs-sm fw-semibold text-muted mb-2">
                                        {{ $examiner->uid }} - {{ $examiner->created_at->diffForHumans() }}
                                    </div>
                                    <p class="text-muted mb-2">
                                        <b>Mobile: {{ $examiner->mobile }}</b>
                                    </p>
                                    <div>
                                        <span class="badge bg-primary">{{ $examiner->ip }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-3">
            <div class="col-12">
                {{ $examiners->links() }}
            </div>
        </div>
    </div>

    <div class="modal fadee" id="modal-default" data-bs-keyboard="false" tabindex="-1" role="dialog"
        aria-labelledby="modal-default" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideup  modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Examiner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="delete_form" enctype="multipart/form-data">
                        @csrf
                        @method('delete')

                        <p class="fs-base mb-0"> Are you sure you want to delete this Examiner? </p>
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
