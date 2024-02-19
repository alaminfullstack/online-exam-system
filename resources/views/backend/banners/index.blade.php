@extends('frontend.layouts.app')

@section('title')
    banner list
@endsection

@section('description')
    banner list
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header border-bottom border-2 ">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">Banner List</h3>
                        <a href="{{ route('admin.banners.create') }}"
                            class="btn btn-primary">Create</a>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            @foreach ($banners as $banner)
                                <div class="col-md-6 col-xl-3">
                                    <div class="block block-rounded shadow-sm">
                                        <div class="block-header">
                                            <div class="flex-grow-1 text-muted fs-sm fw-semibold">
                                                <i class="fa fa-clock me-1"></i>
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
                                                            href="{{ route('admin.banners.edit', $banner->id) }}">
                                                            <i class="fa fa-fw fa-pencil-alt me-1"></i> Edit
                                                        </a>
                                                        <a class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#modal-default"
                                                            onclick="delete_item('{{ route('admin.banners.destroy', $banner->id) }}')"
                                                            href="javascript:void(0)">
                                                            <i class="fa fa-fw fa-times me-1"></i> Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="block-content pb-0">
                                            <img src="{{ $banner->image != null ? asset($banner->image) : asset('assets/media/banner.png') }}"
                                                class="card-img w-100 img-thumb" />
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
                    <h5 class="modal-title">Delete Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                    <form method="POST" action="" id="delete_form" enctype="multipart/form-data">
                        @csrf
                        @method('delete')

                        <p class="fs-base mb-0"> Are you sure you want to delete this Banner? </p>
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
