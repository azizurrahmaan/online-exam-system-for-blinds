@extends('layouts.app')
@section('title',$examination['name'])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Examination') }}</div>
                </div>
                <div class="card-body">
                    <div class="row"> 
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_questions">{{ __('Exam Name:') }}</label>
                                <input disabled id="name" type="text" placeholder="{{ __('IQ Test') }}" class="form-control" name="name" value="{{ $examination['name'] }}" required autocomplete="name" autofocus>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_non_blind">{{ __('Duration in Minutes:') }}</label>
                                <input disabled id="duration_for_non_blind" type="number" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_non_blind" value="@if(Auth::user()->role == 'Blind Student'){{$examination['duration_for_blind']}}@elseif(Auth::user()->role == 'Non-Blind Student') {{$examination['duration_for_non_blind']}}@endif" required autocomplete="duration_for_non_blind">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_non_blind">{{ __('Cick to Start the exam:') }}</label>
                                <form id="start_exam_form" action="{{route('students.do_attempt_examination',['examination'=>$examination['id']])}}" method="POST">@csrf
                                    <input type="number" name="examination_id" hidden value="{{$examination['id']}}">
                                    <button type="submit" class="form-control btn btn-primary">Start Exam</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
@section('scripts')
<script src="{{ asset('js/textToSpeech.js')}}"></script>
<script>
    $(function(){
        @if( Auth::user()->role == "Blind Student" )
                
        speakMenu()

        setInterval(() => {
            textToSpeech("Press m to view menu")
        }, 10000);
        var t_pressed_no_of_times = 0;
        var exam_result_url = undefined;
        $('body').keydown(function(event) { 
            var x = event.which || event.keyCode;
            if(x == 67){//c
                window.speechSynthesis.cancel()
                $("#start_exam_form").submit()
            }else if(x == 72){//h
                
                window.speechSynthesis.cancel()
                window.location="{{route('students.dashboard')}}";
            }else if(x == 76){//l
                
                window.speechSynthesis.cancel()
                $("#logout-form").submit()
            }else if(x == 77){//m
                
                window.speechSynthesis.cancel()
                speakMenu()
            }
        });
        @endif

        })
        function speakMenu(){
        textToSpeech("You are going to attempt {{$examination['name']}} Exam")
        textToSpeech("Duration for this exam is {{$examination['duration_for_blind']}} minutes")
        textToSpeech("press key c to confirm to attempt this exam")
        textToSpeech("press key h to go back to home page")
        textToSpeech("press key l to logout of application")
        }
</script>
@endsection
