@extends('frontend.layouts.app')

@section('title')
    Result {{ $exam->title }}
@endsection

@section('description')
    Result {!! $exam->description !!}
@endsection

@section('image')
    {{ asset($exam->image) }}
@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5 class="text-center mb-3">
                    {{ $exam->title }}
                </h5>


                <div class="block block-rounded text-center">
                    <div class="block-content bg-xwork">
                        <p class="text-white text-uppercase fs-sm fw-bold">
                            Result Status
                        </p>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-4">
                                <div class="js-pie-chart pie-chart" data-percent="{{ $correct_percent }}" data-line-width="3" data-size="70"
                                    data-bar-color="#82b54b" data-track-color="#e9e9e9">
                                    <span>{{ $total_correct }}/{{ $total_questions }}</span>
                                </div>
                                <p class="fw-medium text-muted mt-2 mb-0">
                                    Correct
                                </p>
                            </div>
                            <div class="col-4">
                                <div class="js-pie-chart pie-chart" data-percent="{{ $score_percent }}" data-line-width="3" data-size="70"
                                    data-bar-color="@if($score >= $exam->pass_mark ) #82b54b @else #ffb119 @endif" data-track-color="#e9e9e9">
                                    <span>{{ $score }}/{{ $exam->total_mark }}</span>
                                </div>
                                <p class="fw-medium text-muted mt-2 mb-0">
                                    Score
                                </p>
                            </div>
                            <div class="col-4">
                                <div class="js-pie-chart pie-chart" data-percent="{{ $wrong_percent }}" data-line-width="3" data-size="70"
                                    data-bar-color="#ffb119" data-track-color="#e9e9e9">
                                    <span>{{ $total_wrong }}/{{ $total_questions }}</span>
                                </div>
                                <p class="fw-medium text-muted mt-2 mb-0">
                                    Wrong
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('result_details', [$exam->slug, $examin->uid]) }}" class="btn btn-primary mt-3">Show Details</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="/assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
<script>Dashmix.helpersOnLoad(['jq-easy-pie-chart']);</script>
@endpush
