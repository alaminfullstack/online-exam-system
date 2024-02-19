@extends('frontend.layouts.app')

@section('title')
    banner edit
@endsection

@section('description')
    banner edit
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Dynamic Table with Export Buttons -->
                <div class="block block-rounded">
                    <div class="block-header border-bottom border-2">
                        <h3 class="mb-0 py-1 fs-4 fw-bold">Banner edit</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <form method="POST" action="{{ route('admin.banners.update', $banner->id) }}" enctype="multipart/form-data">
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


                            <div class="row">
                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Link</label>
                                    <input type="text" class="form-control" name="link" value="{{ $banner->link }}">
                                </div>



                                <div class="col-12 col-md-6 mb-4">
                                    <label class="form-label">Banner</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                    <div id="image-preview">
                                        <img src="{{ asset($banner->image) }}" />
                                    </div>
                                </div>

                                <div class="col-12 mb-4">
                                    <label class="form-label">Text</label>
                                    <textarea class="form-control" id="js-ckeditor" rows="6" name="text">{!! $banner->text !!}</textarea>
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
    <script src="{{ asset('assets') }}/js/plugins/ckeditor/ckeditor.js"></script>
    <script>
        Dashmix.helpersOnLoad(['js-ckeditor']);
    </script>

    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    const image = document.createElement('img');
                    image.src = e.target.result;
                    image.style.width = '200px'; // Adjust size as needed
                    image.style.height = 'auto';
                    imagePreview.innerHTML = '';
                    imagePreview.appendChild(image);
                };

                reader.readAsDataURL(e.target.files[0]);
            }
        });
    </script>
@endpush
