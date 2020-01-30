@extends('layouts.app')
@section('title','Exam Result: ' . $examination['name'] )
@section('styles')
  <style>
      .to-be-selected{
          background: #218838;
          color: white;
      }
      .red-border{
          border-color: red;
          color: red;
      }
      .option-row{
          padding:10px;
      }
      .option-row:hover{
          background-color: #80808033;
      }
  </style>
@endsection
@section('content')
<div class="container">
    @php $score=0; @endphp
    @foreach($attempted_exam_questions as $question) @if($question['choosed_option'] == $question['correct_option']) @php $score++ @endphp @endif @endforeach
    @php $percentage = ($score/$examination['total_questions'])*100; @endphp
    @php $status = ($percentage >= $examination['passing_percentage'])? 'Pass':'Fail'; @endphp
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
                                <input disabled id="duration_for_non_blind" type="number" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_non_blind" value="@if($student->role == 'Blind Student'){{$examination['duration_for_blind']}}@elseif($student->role == 'Non-Blind Student') {{$examination['duration_for_non_blind']}}@endif" required autocomplete="duration_for_non_blind">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_non_blind">{{ __('Max Score:') }}</label>
                                <input disabled id="duration_for_non_blind" type="number" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_non_blind" value="{{$examination['total_questions']}}" required autocomplete="duration_for_non_blind">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_non_blind">{{ __('Student Name:') }}</label>
                                <input disabled id="duration_for_non_blind" type="text" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_non_blind" value="{{$student['name']}}" required autocomplete="duration_for_non_blind">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_non_blind">{{ __('Student Email:') }}</label>
                                <input disabled id="duration_for_non_blind" type="email" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_non_blind" value="{{$student['email']}}" required autocomplete="duration_for_non_blind">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_non_blind">{{ __('Student Type:') }}</label>
                                <input disabled id="duration_for_non_blind" type="text" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_non_blind" value="{{$student['role']}}" required autocomplete="duration_for_non_blind">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_non_blind">{{ __('Score:') }}</label>
                                <input disabled id="duration_for_non_blind" type="text" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_non_blind" value="{{$score}}" required autocomplete="duration_for_non_blind">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_non_blind">{{ __('Percentage:') }}</label>
                                <input disabled id="duration_for_non_blind" type="text" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_non_blind" value="{{round($percentage,2)}}" required autocomplete="duration_for_non_blind">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_non_blind">{{ __('Status:') }}</label>
                                <input disabled id="duration_for_non_blind" type="text" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_non_blind" value="{{$status}}" required autocomplete="duration_for_non_blind">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @php $i=0; @endphp
            @foreach($attempted_exam_questions as $question)
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <label>{{++$i}}.  {{$question['subject']}} </label> @if($question['choosed_option'] == 'NILL') <span class="right badge badge-danger"><i class="fas fa-times"></i>&nbsp; Un-Attempted</span> @endif
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{$question['question_text']}}
                    </div>
                    <div class="card-footer">
                        <div class="row option-row">
                            <div class="col-md-12">
                                <b>Option A:</b> {{$question['option_a']}} @if($question['correct_option'] == 'A') <span class="right badge badge-success"><i class="fas fa-check"></i>&nbsp; Correct</span>@endif @if($question['choosed_option'] == 'A') <span class="right badge badge-info"><i class="fas fa-check"></i>&nbsp; Attempted</span> @endif
                                
                            </div>
                        </div>
                        <div class="row option-row">
                            <div class="col-md-12">
                                <b>Option B:</b> {{$question['option_b']}} @if($question['correct_option'] == 'B') <span class="right badge badge-success"><i class="fas fa-check"></i>&nbsp; Correct</span>@endif @if($question['choosed_option'] == 'B') <span class="right badge badge-info"><i class="fas fa-check"></i>&nbsp; Attempted</span> @endif
                                
                            </div>
                        </div>
                        @if($question['option_c'])
                        <div class="row option-row">
                            <div class="col-md-12">
                                <b>Option C:</b> {{$question['option_c']}} @if($question['correct_option'] == 'C') <span class="right badge badge-success"><i class="fas fa-check"></i>&nbsp; Correct</span>@endif @if($question['choosed_option'] == 'C') <span class="right badge badge-info"><i class="fas fa-check"></i>&nbsp; Attempted</span> @endif 
                                
                            </div>
                        </div>
                        @endif
                        @if($question['option_d'])
                        <div class="row option-row">
                            <div class="col-md-12">
                                <b>Option D:</b> {{$question['option_d']}} @if($question['correct_option'] == 'D') <span class="right badge badge-success"><i class="fas fa-check"></i>&nbsp; Correct</span>@endif @if($question['choosed_option'] == 'D') <span class="right badge badge-info"><i class="fas fa-check"></i>&nbsp; Attempted</span> @endif
                                 
                            </div>
                        </div>
                        @endif
                        @if($question['option_e'])
                        <div class="row option-row">
                            <div class="col-md-12"> 
                                <b>Option E:</b> {{$question['option_e']}} @if($question['correct_option'] == 'E') <span class="right badge badge-success"><i class="fas fa-check"></i>&nbsp; Correct</span>@endif @if($question['choosed_option'] == 'E') <span class="right badge badge-info"><i class="fas fa-check"></i>&nbsp; Attempted</span> @endif 
                                
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection
@section('scripts')
<script src="{{ asset('js/textToSpeech.js')}}"></script>
<script>
    $(function () {
        @if( Auth::user()->role == "Blind Student" )
                    
            speakMenu()

            setInterval(() => {
                textToSpeech("Press m to view menu")
            }, 10000);

            $('body').keydown(function(event) { 

                var x = event.which || event.keyCode;
                if(x == 72){//h
                    window.location="{{route('students.dashboard')}}";
                }else if(x == 76){//l
                    $("#logout-form").submit()
                }else if(x == 77){//m
                    speakMenu()
                }

            });
            @endif
    })
    function speakMenu(){
        textToSpeech("You are viewing Exam {{ $examination['name'] }} result")
        textToSpeech("Duration for this exam was {{$examination['duration_for_blind']}} minutes")
        textToSpeech("Max Scores were {{$examination['total_questions']}}")
        textToSpeech("Your Scores were {{$score}}")
        textToSpeech("Your percentage was {{round($percentage,2)}}")
        textToSpeech("Your status in this exam is {{$status}}")

        textToSpeech("press key h to go back to home")
        textToSpeech("press key l to logout of application")
    }
</script>
@endsection
