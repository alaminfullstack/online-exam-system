@extends('frontend.layouts.app')

@section('title')
    {{ $exam->title }}
@endsection

@section('description')
    {!! $exam->description !!}
@endsection

@section('image')
    {{ asset($exam->image) }}
@endsection



@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <a class="block block-rounded block-transparent block-link-pop bg-gd-fruit mb-3" href="#">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div>
                            <p class="fs-4 fw-semibold mb-0 text-white">
                                {{ $exam->title ?? null }}
                            </p>

                            <p class="text-white-75 mb-0">
                                <span>Total Mark : </span> <b>{{ $exam->total_mark }}</b>, <span>Pass Mark : </span>
                                <b>{{ $exam->pass_mark }}</b>, <span>Total Ques : </span> <b>{{ count($questions) }}</b>
                            </p>


                        </div>
                    </div>
                </a>

                <div class="block block-rounded block-transparent block-link-pop bg-primary mb-3 position-sticky"
                    style="top: 0px;">
                    <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                        <div>
                            <h4 class="fs-lg fw-semibold mb-0 text-white"><span id="iTimeShow">Time Remaining:
                                </span>
                                <span id='timer' class="text-warning"></span>
                            </h4>

                        </div>
                    </div>
                </div>

                <form id="answer-form" name="answer-form" action="{{ route('online_exam_submit', $exam->slug) }}"
                    method="POST">
                    @csrf

                    <div class="row">

                        @if ($exam->exam_type == 'mcq')
                            @foreach ($questions as $question)
                                <div class="col-md-6">
                                    <div class="block block-rounded mb-3 p-3">
                                        <label class="form-label"><b>Q-{{ $loop->iteration }}</b> :
                                            {!! $question->question_title !!}</label>
                                        <div class="space-y-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    id="example-radios-default1-{{ $question->id }}"
                                                    name="question[{{ $question->id }}]" value="option_1">
                                                <label class="form-check-label"
                                                    for="example-radios-default1-{{ $question->id }}">{{ $question->option_1 }}</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    id="example-radios-default2-{{ $question->id }}"
                                                    name="question[{{ $question->id }}]" value="option_2">
                                                <label class="form-check-label"
                                                    for="example-radios-default2-{{ $question->id }}">{{ $question->option_2 }}</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    id="example-radios-default3-{{ $question->id }}"
                                                    name="question[{{ $question->id }}]" value="option_3">
                                                <label class="form-check-label"
                                                    for="example-radios-default3-{{ $question->id }}">{{ $question->option_3 }}</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    id="example-radios-default4-{{ $question->id }}"
                                                    name="question[{{ $question->id }}]" value="option_4">
                                                <label class="form-check-label"
                                                    for="example-radios-default4-{{ $question->id }}">{{ $question->option_4 }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        @if ($exam->exam_type == 'mcqx')
                            @foreach ($questions as $question)
                                <div class="col-md-6">
                                    <div class="block block-rounded mb-3 p-3">
                                        <label class="form-label"><b>Q-{{ $loop->iteration }}</b> :
                                            {!! $question->question_title !!}</label>
                                        <div class="space-y-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="example-checkboxs-default1-{{ $question->id }}"
                                                    name="question[{{ $question->id }}][]" value="option_1">
                                                <label class="form-check-label"
                                                    for="example-checkboxs-default1-{{ $question->id }}">{{ $question->option_1 }}</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="example-checkboxs-default2-{{ $question->id }}"
                                                    name="question[{{ $question->id }}][]" value="option_2">
                                                <label class="form-check-label"
                                                    for="example-checkboxs-default2-{{ $question->id }}">{{ $question->option_2 }}</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="example-checkboxs-default3-{{ $question->id }}"
                                                    name="question[{{ $question->id }}][]" value="option_3">
                                                <label class="form-check-label"
                                                    for="example-checkboxs-default3-{{ $question->id }}">{{ $question->option_3 }}</label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="example-checkboxs-default4-{{ $question->id }}"
                                                    name="question[{{ $question->id }}][]" value="option_4">
                                                <label class="form-check-label"
                                                    for="example-checkboxs-default4-{{ $question->id }}">{{ $question->option_4 }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                        <div class="col-12 mb-5">
                            <button type="button" id="submit-answer" class="btn btn-primary">Submit</button>
                        </div>
                    </div>

                    <div class="modal" id="modal-default-small" tabindex="-1" role="dialog"
                        aria-labelledby="modal-default-small" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>You have <span id="modalUnansweredCount"></span> unanswered question(s). If You Want
                                        To Submit Anyway?</p>

                                    <div>
                                        <button type="submit" class="btn btn-success">Yes</button>
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"
                                            aria-label="Close">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="modal fade" id="modal-default" tabindex="-1" data-bs-backdrop="static"
                        data-bs-keyboard="false" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">

                                    <div class="row">
                                        <div class="col-12 mb-4">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control" id="name" name="name"
                                                value="@if ($examiner != null) {{ $examiner->name }} @endif" required>
                                        </div>

                                        <div class="col-12 mb-4">
                                            <label class="form-label">Mobile</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile"
                                                value="@if ($examiner != null) {{ $examiner->mobile }} @endif"
                                                required>
                                        </div>


                                        <div class="col-12">
                                            <button type="button" id="continue" class="btn btn-lg btn-primary">
                                                Continue
                                            </button>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </form>


            </div>
        </div>
    </div>


@endsection

@push('js')
    @if ($examiner == null)
        <script>
            $(document).ready(function() {
                $('#modal-default').modal('show');
            });
        </script>
    @endif

    <script>
        // document.addEventListener('visibilitychange', function() {
        //     if (document.visibilityState === 'hidden') {
        //         document.forms['answer-form'].submit();
        //         document.body.innerHTML = `
    //                 <div class="d-flex flex-wrap justify-content-center align-items-center clear-msg">
    //                         <h3 class="text-danger text-center">@lang('Sorry you can\'t go anywhere from this tab while viewing an exam')</h3>
    //                     </div>
    //                 `;
        //     }
        // });

        $('#continue').click(function() {
            let name = $('#name').val();
            let mobile = $('#mobile').val();

            if (name != '' && mobile != '' && mobile.length == 11) {
                $('#modal-default').modal('hide');
            } else {
                Dashmix.helpers('jq-notify', {
                    type: 'danger',
                    icon: 'fa fa-times me-1',
                    message: 'Name and mobile field is required and mobile number should be 11 number'
                });
            }
        });

        var currentQuestion = 0;
        var correctAnswers = 0;
        var quizOver = false;
        var c = @json($exam->duration) * 60;
        var t;

        $(document).ready(function() {
            timedCount();
        });



        function timedCount() {
            if (c == 185) {
                return false;
            }

            var hours = parseInt(c / 3600) % 24;
            var minutes = parseInt(c / 60) % 60;
            var seconds = c % 60;
            var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (
                seconds < 10 ? "0" + seconds : seconds);
            $('#timer').html(result);

            if (c == 0) {
                $('#iTimeShow').html('Exam Time Over!');
                document.forms['answer-form'].submit();
                // $('#timer').html("You scored: " + correctAnswers + " out of: " + questions.length);
                c = 185;
                quizOver = true;
                return false;

            }

            c = c - 1;
            t = setTimeout(function() {
                timedCount()
            }, 1000);
        }

        $('#submit-answer').click(function() {
            var answeredQuestions = $('input[type="radio"]:checked').length;
            var totalQuestions =
                {{ count($questions) }}; // Get the total number of questions from your PHP variable
            var unansweredQuestions = totalQuestions - answeredQuestions;

            if (unansweredQuestions > 0) {
                // Display a modal with the count of unanswered questions
                $('#modalUnansweredCount').text(unansweredQuestions);
                $('#modal-default-small').modal('show'); // Assuming you have a modal with the id "myModal"
            } else {
                // All questions have been answered, submit the form
                $('#answer-form').submit();
            }
        });

        $('#submit-answer').click(function() {
            var answeredQuestions = $('input[type="checkbox"]:checked').length;
            var totalQuestions =
                {{ count($questions) }}; // Get the total number of questions from your PHP variable
            var unansweredQuestions = totalQuestions - answeredQuestions;

            if (unansweredQuestions > 0) {
                // Display a modal with the count of unanswered questions
                $('#modalUnansweredCount').text(unansweredQuestions);
                $('#modal-default-small').modal('show'); // Assuming you have a modal with the id "myModal"
            } else {
                // All questions have been answered, submit the form
                $('#answer-form').submit();
            }
        });
    </script>
@endpush
