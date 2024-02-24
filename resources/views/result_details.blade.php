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
            @if ($first_banner != null)
                <div class="col-12 mb-3">
                    @if ($first_banner->image != null)
                        <a href="{{ $first_banner->link }}">
                            <img src="{{ asset($first_banner->image) }}" class="card-img" />
                        </a>
                    @else
                        <div>
                            {!! $first_banner->text !!}
                        </div>
                    @endif
                </div>
            @endif

            <div class="col-12">
                <h5 class="text-center mb-3">
                    {{ $exam->title }}
                </h5>

                @if ($examin != null)
                    <p class="mb-2"><b>Name </b> : {{ $examin->name }}</p>
                    <p class="mb-2"><b>Mobile </b> : {{ $examin->mobile }}</p>
                    <p class="mb-2"><b>Date </b> : {{ $examin->created_at->format('d-m-Y h:i:s') }}</p>
                @endif

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


                <div class="row mt-3">
                    @foreach ($questions as $question)
                        <div class="col-md-6 col-xl-3">
                            <div class="block block-rounded mb-3">
                                <div class="block-header">
                                    <div class="flex-grow-1 text-muted fs-md fw-bold">
                                        <b>Q-{{ $loop->iteration }} : </b> {!! $question->question_title !!}
                                    </div>
                                </div>


                                <div class="block-content">
                                    @php
                                        $color1 = '';
                                        $color2 = '';
                                        $color3 = '';
                                        $color4 = '';
                                        if ($exam->exam_type == 'mcqx') {
                                            foreach ($answers as $id => $ans) {
                                                if ($question->id == $id) {
                                                    if (in_array('option_1', json_decode($ans))) {
                                                        $color1 = 'text-danger';
                                                        if (in_array('option_1', json_decode($question->correct_option))) {
                                                            $color1 = 'text-success';
                                                        }
                                                    }

                                                    if (in_array('option_2', json_decode($ans))) {
                                                        $color2 = 'text-danger';
                                                        if (in_array('option_2', json_decode($question->correct_option))) {
                                                            $color2 = 'text-success';
                                                        }
                                                    }

                                                    if (in_array('option_3', json_decode($ans))) {
                                                        $color3 = 'text-danger';
                                                        if (in_array('option_3', json_decode($question->correct_option))) {
                                                            $color3 = 'text-success';
                                                        }
                                                    }

                                                    if (in_array('option_4', json_decode($ans))) {
                                                        $color4 = 'text-danger';
                                                        if (in_array('option_4', json_decode($question->correct_option))) {
                                                            $color4 = 'text-success';
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            foreach ($answers as $id => $ans) {
                                                if ($question->id == $id) {
                                                    if ('option_1' == $ans) {
                                                        $color1 = 'text-danger';
                                                        if ('option_1' == $question->correct_option) {
                                                            $color1 = 'text-success';
                                                        }
                                                    }

                                                    if ('option_2' == $ans) {
                                                        $color2 = 'text-danger';
                                                        if ('option_2' == $question->correct_option) {
                                                            $color2 = 'text-success';
                                                        }
                                                    }

                                                    if ('option_3' == $ans) {
                                                        $color3 = 'text-danger';
                                                        if ('option_3' == $question->correct_option) {
                                                            $color3 = 'text-success';
                                                        }
                                                    }

                                                    if ('option_4' == $ans) {
                                                        $color4 = 'text-danger';
                                                        if ('option_4' == $question->correct_option) {
                                                            $color4 = 'text-success';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    @endphp




                                    @if ($exam->exam_type == 'mcqx')
                                        <p class="fs-sm fw-medium text-muted mt-1">
                                            @if (in_array('option_1', json_decode($question->correct_option)))
                                                <i class="fa fa-fw fa-check me-1"></i>
                                            @endif

                                            <span class="{{ $color1 }}">{{ $question->option_1 }}</span>
                                        </p>

                                        <p class="fs-sm fw-medium text-muted mt-1">
                                            @if (in_array('option_2', json_decode($question->correct_option)))
                                                <i class="fa fa-fw fa-check me-1"></i>
                                            @endif

                                            <span class="{{ $color2 }}">{{ $question->option_2 }}</span>
                                        </p>

                                        <p class="fs-sm fw-medium text-muted mt-1">
                                            @if (in_array('option_3', json_decode($question->correct_option)))
                                                <i class="fa fa-fw fa-check me-1"></i>
                                            @endif

                                            <span class="{{ $color3 }}">{{ $question->option_3 }}</span>
                                        </p>

                                        <p class="fs-sm fw-medium text-muted mt-1">
                                            @if (in_array('option_4', json_decode($question->correct_option)))
                                                <i class="fa fa-fw fa-check me-1"></i>
                                            @endif

                                            <span class="{{ $color4 }}">{{ $question->option_4 }}</span>
                                        </p>
                                    @else
                                        <p class="fs-sm fw-medium text-muted mt-1">
                                            @if ($question->correct_option == 'option_1')
                                                <i class="fa fa-fw fa-check me-1"></i>
                                            @endif

                                            <span class="{{ $color1 }}">{{ $question->option_1 }}</span>
                                        </p>

                                        <p class="fs-sm fw-medium text-muted mt-1">
                                            @if ($question->correct_option == 'option_2')
                                                <i class="fa fa-fw fa-check me-1"></i>
                                            @endif

                                            <span class="{{ $color2 }}">{{ $question->option_2 }}</span>
                                        </p>

                                        <p class="fs-sm fw-medium text-muted mt-1">
                                            @if ($question->correct_option == 'option_3')
                                                <i class="fa fa-fw fa-check me-1"></i>
                                            @endif



                                            <span class="{{ $color3 }}">{{ $question->option_3 }}</span>
                                        </p>

                                        <p class="fs-sm fw-medium text-muted mt-1">
                                            @if ($question->correct_option == 'option_4')
                                                <i class="fa fa-fw fa-check me-1"></i>
                                            @endif
                                            <span class="{{ $color4 }}">{{ $question->option_4 }}</span>
                                        </p>
                                    @endif
                                </div>

                                @if ($question->note != null)
                                    <div class="block-content p-2">
                                        <p><b>Answer Note : </b></p>
                                        {!! $question->note !!}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            @if ($last_banner != null)
                <div class="col-12 mt-3">
                    @if ($last_banner->image != null)
                        <a href="{{ $last_banner->link }}">
                            <img src="{{ asset($last_banner->image) }}" class="card-img" />
                        </a>
                    @else
                        <div>
                            {!! $last_banner->text !!}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
@endsection

@push('js')
<script src="/assets/js/plugins/easy-pie-chart/jquery.easypiechart.min.js"></script>
<script>Dashmix.helpersOnLoad(['jq-easy-pie-chart']);</script>
@endpush
