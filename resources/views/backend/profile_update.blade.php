@extends('frontend.layouts.app')

@section('title')
    Profile Update
@endsection

@section('description')
    Profile Update
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mx-auto">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header border-bottom border-2">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">Password Update</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form method="POST" action="{{ route('admin.update_profile') }}" class="submit-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 col-lg-12">
                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $user->name }}" />
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $user->email }}" />
                                        </div>
                                        <div class="col-12 mb-4">
                                            <label class="form-label">New Password</label>
                                            <input type="password" class="form-control" name="password" />
                                        </div>

                                        <div class="col-12 mb-4">
                                            <label class="form-label">Confirmed Pasword</label>
                                            <input type="password" class="form-control" name="password_confirmation" />
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-outline-primary mb-3">
                                                Update
                                            </button>
                                        </div>
                                    </div>
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
