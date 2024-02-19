@extends('frontend.layouts.app')

@section('title')
    Login
@endsection

@section('description')
    Login
@endsection



@section('content')
<div class="container">
    <!-- Form Grid with Labels -->
    <form method="POST" action="{{ route('save_login') }}" enctype="multipart/form-data">
        @csrf

        {{-- class="submit-form" --}}


        <div class="row">
            <div class="col-md-6 mx-auto">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header border-bottom border-2">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">Admin Login</h3>
                    </div>
                    <div class="block-content block-content-full">
                        @if ($errors->any())
                            <div class="mb-3">
                                <div class="">
                                    @foreach ($errors->all() as $error)
                                        <strong class="d-block text-danger">{{ $error }}</strong>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-12 mb-4">
                                <label class="form-label">Email</label>
                                <input type="text" class="form-control" name="email" value="">
                            </div>

                            <div class="col-12  mb-4">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-lg btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
        </div>


    </form>
</div>
@endsection

@push('js')
@endpush
