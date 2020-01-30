@extends('layouts.app')
@section('title','Attempting Exam: '. $examination['name'])
@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset("/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">
  <style>
        .to-be-selected{
            background: #218838;
            color: white;
        }
      .to-be-selected:hover{
          background: #218838;
          color: white;
      }
      .red-border{
          border-color: red;
          color: red;
      }
      .option-row{
          padding:10px;
          width: 100%;
          border-radius:5px; 
      }
      .option-value{
        font-weight: 400;
      }
      .option-row:hover{
            background: #218838;
            color: white;
      }
  </style>
@endsection
@section('title_front')
<label style="float:right; font-size:25px; font-weight:400;">
    Total Time: {{$exam_attempt_time}} minute(s) | 
    Time Left: <span  style="font-weight:600;" id="time-elapsed">00:00</span>
</label>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form id="exam-form" action="{{route('students.save_attempted_exam', ['examination'=> $examination['id']])}}" method="POST">
                @csrf
                @php $i=0; @endphp
                @foreach($exam_questions as $question)
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <label>{{++$i}}. {{$question['subject']}} </label>
                            </div>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            {{$question['question_text']}}
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="option-row" for="{{$question['exam_question_id']}}-A"><input {{--required--}} id="{{$question['exam_question_id']}}-A" type="radio" name="{{$question['exam_question_id']}}" value="A"><b>&nbsp;&nbsp;A: &nbsp;&nbsp;</b> <span class="option-value">{{$question['option_a']}}</span> </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="option-row" for="{{$question['exam_question_id']}}-B"><input {{--required--}} id="{{$question['exam_question_id']}}-B" type="radio" name="{{$question['exam_question_id']}}" value="B"><b>&nbsp;&nbsp;B: &nbsp;&nbsp;</b> <span class="option-value">{{$question['option_b']}}</span> </label>
                                </div>
                            </div>
                            @if($question['option_c'])
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="option-row" for="{{$question['exam_question_id']}}-C"><input {{--required--}} id="{{$question['exam_question_id']}}-C" type="radio" name="{{$question['exam_question_id']}}" value="C"><b>&nbsp;&nbsp;C: &nbsp;&nbsp;</b> <span class="option-value">{{$question['option_c']}}</span> </label>
                                </div>
                            </div>
                            @endif
                            @if($question['option_d'])
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="option-row" for="{{$question['exam_question_id']}}-D"><input {{--required--}} id="{{$question['exam_question_id']}}-D" type="radio" name="{{$question['exam_question_id']}}" value="D"><b>&nbsp;&nbsp;D: &nbsp;&nbsp;</b> <span class="option-value">{{$question['option_d']}} </span> </label>
                                </div>
                            </div>
                            @endif
                            @if($question['option_e'])
                            <div class="row">
                                <div class="col-md-12"> 
                                    <label class="option-row" for="{{$question['exam_question_id']}}-E"><input {{--required--}} id="{{$question['exam_question_id']}}-E" type="radio" name="{{$question['exam_question_id']}}" value="E"><b>&nbsp;&nbsp;E: &nbsp;&nbsp;</b> <span class="option-value">{{$question['option_e']}}</span> </label>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12 mb-2">
                        <button type="submit" class="btn btn-primary btn-block">Submit Answers</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<!-- DataTables -->
<script src="{{ asset("/admin-lte/plugins/datatables/jquery.dataTables.js")}}"></script>
<script src="{{ asset("/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>
<script src="{{asset('js/textToSpeech.js')}}"></script>
<script>
    var total_minutes_remaining;
    var total_seconds_remaining;
    
    let questions = $(".card");
    let no_of_questions = questions.length;
    let question_index = 0;

    $(function () {
        
       @if( Auth::user()->role != "Blind Student" )
            $('body').keydown(function(event) { 
                return false;
            });
        @endif

        $('.option-row').on('click', function(){
            $(this).parent().parent().parent().find('input[type="radio"]').each(function (index, elem) { 
                if($(this).is(':checked')){
                    $(this).parent().addClass('to-be-selected');
                }else{
                    $(this).parent().removeClass('to-be-selected');
                }
            })
            
        });
        updateRemainingTime()
        var countdown = setInterval(updateRemainingTime, 1000);

        function updateRemainingTime(){
            $.post({
                url: '{{ route('examinations.time_left')}}',
                //dataType: "application/json"
                data: {
                    _token:  '{{ csrf_token() }}',
                    exam_id: '{{$examination["id"]}}',
                    std_id: '{{Auth::user()->id}}'
                },
                success: function(data){
                    if(data['time_elapsed'] == 'timeup'){
                        $("#time-elapsed").text("Time\'s Up");
                        clearInterval(countdown);
                        $('#exam-form').submit()
                        return;
                    }
                    let time_elapsed_mins = "";
                    let time_elapsed_secs = "";
                    if(data['time_elapsed'] >= 60){
                        time_elapsed_mins = Math.floor(data['time_elapsed']/60) + "";
                        time_elapsed_secs = data['time_elapsed']%60 + "";
                    }else{
                        time_elapsed_secs = data['time_elapsed'];
                    }
                    if(time_elapsed_mins == ''){
                        time_elapsed_mins='00';
                    }
                    else if(time_elapsed_mins.length < 2){
                        time_elapsed_mins = '0' + time_elapsed_mins;
                    }
                    if(time_elapsed_secs.length < 2){
                        time_elapsed_secs = '0' + time_elapsed_secs;
                    }
                    total_minutes_remaining = (Number({{$exam_attempt_time}}) - Number(time_elapsed_mins))  - Number(1);
                    total_seconds_remaining = (Number(60) - Number(time_elapsed_secs)) ;
                    total_minutes_remaining += "";
                    total_seconds_remaining += "";
                    
                    if(total_minutes_remaining == ''){
                        total_minutes_remaining='00';
                    }
                    else if(total_minutes_remaining.length < 2){
                        total_minutes_remaining = '0' + total_minutes_remaining;
                    }
                    if(total_seconds_remaining.length < 2){
                        total_seconds_remaining = '0' + total_seconds_remaining;
                    }

                    $("#time-elapsed").text(total_minutes_remaining + ':' + total_seconds_remaining)
                },
            });
        }

        @if( Auth::user()->role == "Blind Student" )
                
            speakMenu()

            setInterval(() => {
                textToSpeech("Press m to view menu")
            }, 10000);
            var t_pressed_no_of_times = 0;
            var exam_result_url = undefined;

            $('body').keydown(function(event) { 
                var x = event.which || event.keyCode;
                // alert(x)
                if(x == 77){//m
                    window.speechSynthesis.cancel()
                    speakMenu()
                }else if(x ==76){//l
                    window.speechSynthesis.cancel()
                    textToSpeech(Number(total_minutes_remaining) + " minutes and " + Number(total_seconds_remaining) + " seconds are left")
                }else if(x ==83){//s
                    window.speechSynthesis.cancel()
                    textToSpeech("Submitting exam")
                    setTimeout(() => {
                        $("#exam-form").submit()
                    }, 2000);
                }else if(x ==82){//r
                    window.speechSynthesis.cancel()
                    if($(questions[question_index-1]).find('.card-body').text() == "" || 
                        $(questions[question_index-1]).find('.card-body').text() == null || 
                        $(questions[question_index-1]).find('.card-body').text() == undefined){
                        textToSpeech("you have not selected any question to read")
                    }else{
                        textToSpeech($(questions[question_index-1]).find('.card-body').text())
                        textToSpeech("Press o to traverse options")
                    }
                }else if(x ==79){//o
                    window.speechSynthesis.cancel()
                    if($(questions[question_index-1]).find('.card-body').text() == "" || 
                        $(questions[question_index-1]).find('.card-body').text() == null || 
                        $(questions[question_index-1]).find('.card-body').text() == undefined){
                        textToSpeech("you have not selected any question to read its options")
                    }else{
                        textToSpeech($(questions[question_index-1]).find('.card-footer').text())
                        textToSpeech("Press o to read options again")
                        textToSpeech("Press alphabet of option to choose it")
                    }
                }else if(x ==65){//a
                    window.speechSynthesis.cancel()
                    if($(questions[question_index-1]).find('.card-footer').children()[0] == undefined){
                        textToSpeech("the question you are standing on has no option a")
                    }else{
                        textToSpeech("choosed option 'A' as answer to question " + (Number(question_index)))
                        let option = $($($(questions[question_index-1]).find('.card-footer').children()[0]).find('.option-row'))
                        option.click()
                        option.click()
                    }
                }else if(x ==66){//b
                    window.speechSynthesis.cancel()
                    if($(questions[question_index-1]).find('.card-footer').children()[1] == undefined){
                        textToSpeech("the question you are standing on has no option b")
                    }else{
                        textToSpeech("choosed option 'B' as answer to question " + (Number(question_index)))
                        let option = $($($(questions[question_index-1]).find('.card-footer').children()[1]).find('.option-row'))
                        option.click()
                        option.click()
                    }
                }else if(x ==67){//c
                    window.speechSynthesis.cancel()
                    if($(questions[question_index-1]).find('.card-footer').children()[2] == undefined){
                        textToSpeech("the question you are standing on has no option c")
                    }else{
                        textToSpeech("choosed option 'c' as answer to question " + (Number(question_index)))
                        let option = $($($(questions[question_index-1]).find('.card-footer').children()[2]).find('.option-row'))
                        option.click()
                        option.click()
                    }
                }else if(x ==68){//d
                    window.speechSynthesis.cancel()
                    if($(questions[question_index-1]).find('.card-footer').children()[3] == undefined){
                        textToSpeech("the question you are standing on has no option d")
                    }else{
                        textToSpeech("choosed option 'd' as answer to question " + (Number(question_index)))
                        let option = $($($(questions[question_index-1]).find('.card-footer').children()[3]).find('.option-row'))
                        option.click()
                        option.click()
                    }
                }else if(x ==69){//e
                    window.speechSynthesis.cancel()
                    if($(questions[question_index-1]).find('.card-footer').children()[4] == undefined){
                        textToSpeech("the question you are standing on has no option e")
                    }else{
                        textToSpeech("choosed option 'e' as answer to question " + (Number(question_index)))
                        let option = $($($(questions[question_index-1]).find('.card-footer').children()[4]).find('.option-row'))
                        option.click()
                        option.click()
                    }
                }else if(x ==84){//t
                    window.speechSynthesis.cancel()
                    if(question_index == no_of_questions){
                        question_index = 0;
                    }
                    textToSpeech("your are standing on question " + $(questions[question_index]).find('.card-title').find('label').text())
                    textToSpeech("press r to read the question")
                    console.log(questions[question_index])

                    question_index++;
                }
            });
        @endif
    })

    function speakMenu(){
        textToSpeech("You are attempting {{$examination['name']}} Exam")
        textToSpeech("Duration for this exam is {{$examination['duration_for_blind']}} minutes")
        textToSpeech("Exam has " + no_of_questions + " questions")
        textToSpeech("Press l for time left")
        textToSpeech("Press t to traverse questions")
        textToSpeech("Press s to submit your exam")
    }
</script>
@endsection
