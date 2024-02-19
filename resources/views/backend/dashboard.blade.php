@extends('frontend.layouts.app')

@section('title')
    Dashboard
@endsection

@section('description')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="block block-rounded block-link-shadow">
                    <div
                        class="block-content block-content-full d-flex flex-row-reverse align-items-center justify-content-between">
                        <a href="" class="btn btn-sm btn-link text-danger">
                            View all
                        </a>
                        <div class="me-3">
                            <p class=" mb-0 fs-base">Exam Information</p>
                            <p class="fs-sm fw-medium text-muted mb-0">
                                Total Exam : <b class="text-warning">{{ $total_exam ?? 0 }}</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="block block-rounded block-link-shadow">
                    <div
                        class="block-content block-content-full d-flex flex-row-reverse align-items-center justify-content-between">
                        <a href="" class="btn btn-sm btn-link text-danger">
                            View all
                        </a>
                        <div class="me-3">
                            <p class=" mb-0 fs-base">Examiner Information</p>
                            <p class="fs-sm fw-medium text-muted mb-0">
                                Total Examiner : <b class="text-warning">{{ $total_student ?? null }}</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="block block-rounded block-link-shadow">
                    <div
                        class="block-content block-content-full d-flex flex-row-reverse align-items-center justify-content-between">
                        <a href="" class="btn btn-sm btn-link text-danger">
                            View all
                        </a>
                        <div class="me-3">
                            <p class="mb-0 fs-base">Profile Setting</p>
                            <p class="fs-sm fw-medium text-muted mb-0">
                                Update Profile
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
