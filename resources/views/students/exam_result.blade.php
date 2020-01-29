@extends('layouts.app')
@section('title','Exam Result: ' . $examination['name'] )
@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset("/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">
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
<!-- DataTables -->
<script src="{{ asset("/admin-lte/plugins/datatables/jquery.dataTables.js")}}"></script>
<script src="{{ asset("/admin-lte/plugins/datatables-bs4/js/dataTables.bootstrap4.js")}}"></script>
<script>
    $(function () {
      $('#questions_table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
      $("#save_selected_question_in_exam_form").on('submit', function(){
          let count = 0;
        $("input[name='question_to_be_added[]']").each(function(index, elem){
            if($(this).is(':checked')){
                count++;
            }
        })
        if(count == 0){
            alert('No Question Selected from Pool!');
            return false;
        }else if((Number(count)+Number($("#total_questions_added").val())) > $("#total_questions").val()){
            console.log(Number(count)+$("#total_questions_added").val());
            alert('No More than ' + (Number($("#total_questions").val()) - $("#total_questions_added").val()) + ' questions for this exam can be selected!');
            return false;
        }else{
            return true;
        }
      })
      $('.optional-option-enabler').on('change', function(){
          let text_input = $(this).parent().parent().parent().find('input[type="text"]');
          let radio_input = $(this).parent().parent().parent().find('input[type="radio"]');
        if($(this).is(':checked')){
            text_input.removeAttr('disabled');
            text_input.attr('required','true');
            radio_input.removeAttr('disabled');
            radio_input.attr('required','true');
        }else{
            radio_input.attr('disabled','disabled');
            radio_input.removeAttr('required');
            text_input.attr('disabled','disabled');
            text_input.removeAttr('required');
        }
      })
      $("#enable-option-d").on('click', function(){
          if($(this).is(':checked') && !$("#enable-option-c").is(':checked')){
            $("#enable-option-c").click()
          }
      })
      $("#enable-option-e").on('click', function(){
          if($(this).is(':checked') && !$("#enable-option-c").is(':checked')){
            $("#enable-option-c").click()
          }
          if($(this).is(':checked') && !$("#enable-option-d").is(':checked')){
            $("#enable-option-d").click()
          }
      })
      $("#enable-option-c").on('click', function(){
          if(!$(this).is(':checked') && $("#enable-option-d").is(':checked')){
            $("#enable-option-d").click()
          }
          if(!$(this).is(':checked') && $("#enable-option-e").is(':checked')){
            $("#enable-option-e").click()
          }
      })
      $("#enable-option-d").on('click', function(){
          if(!$(this).is(':checked') && $("#enable-option-e").is(':checked')){
            $("#enable-option-e").click()
          }
      })
      $("[data-target='#modal-danger']").on('click', function(){
          let title = $(this).data('title');
          let question_text = $(this).data('question-text');
          let id = $(this).data('id');
        $("#title-span").text(title);
        $("#question-text-span").text(question_text);
        $("#confirm-delete-button").attr('data-form-id',id);
      })
      $("#confirm-delete-button").on('click', function(){
        $('#form-'+$(this).data('form-id')).submit();
      })

      $('.add-in-exam-btn').on('click', function(){
          if(!$(this).parent().find('input[type="checkbox"]').is(':checked')){
            $(this).parent().find('input[type="checkbox"]').attr('checked','checked')
            $(this).parent().parent().addClass('to-be-selected');
            $(this).removeClass('btn-success');
            $(this).text('Selected');
            $(this).addClass('btn-default');
          }else{
            $(this).parent().parent().removeClass('to-be-selected');
            $(this).removeClass('btn-default');
            $(this).addClass('btn-success');
            $(this).text('Select for Exam');
            $(this).parent().find('input[type="checkbox"]').removeAttr('checked')
          }
      })
    })
</script>
@endsection
