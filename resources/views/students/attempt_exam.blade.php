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
    Time Elapsed: <span  style="font-weight:600;" id="time-elapsed">00:00</span>
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
<script>
    $(function () {
        $('body').keydown(function(event) { 
            return false;
        });
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
                    console.log(data['time_elapsed'])
                    if(data['time_elapsed'] == 'timeup'){
                        $("#time-elapsed").text("Time\'s Up");
                        clearInterval(countdown);
                        $('#exam-form').submit()
                        return;
                    }
                    let time_elapsed_mins = "";
                    let time_elapsed_secs = "";
                    if(data['time_elapsed'] > 60){
                        time_elapsed_mins = Math.round(data['time_elapsed']/60) + "";
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
                    $("#time-elapsed").text(time_elapsed_mins + ':' + time_elapsed_secs)
                },
            });
        }

        
    })
</script>
@endsection
