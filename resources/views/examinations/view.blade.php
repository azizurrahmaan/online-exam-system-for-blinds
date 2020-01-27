@extends('layouts.app')
@section('title','View Examination')
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Examination') }}</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
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
                                <label for="total_questions">{{ __('Total Questions:') }}</label>
                                <input disabled id="total_questions" type="number" placeholder="{{ __('20, 25 or 30 etc') }}" class="form-control" name="total_questions" value="{{ $examination['total_questions'] }}" required autocomplete="total_questions">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="total_questions_added">{{ __('Total Questions Added:') }}</label>
                                <input disabled id="total_questions_added" type="number" placeholder="{{ __('20, 25 or 30 etc') }}" class="form-control" name="total_questions_added" value="{{ $included_questions_count }}" required autocomplete="total_questions_added">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="passing_percentage">{{ __('Passing Percentage:') }}</label>
                                <input disabled id="passing_percentage" type="number" placeholder="{{ __('20, 25 or 30 etc') }}" class="form-control" name="passing_percentage" value="{{ $examination['passing_percentage'] }}" required autocomplete="passing_percentage">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_non_blind">{{ __('Duration for Non-Blind Students in Minutes:') }}</label>
                                <input disabled id="duration_for_non_blind" type="number" placeholder="{{ __('20, 25 or 30 etc') }}" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_non_blind" value="{{ $examination['duration_for_non_blind'] }}" required autocomplete="duration_for_non_blind">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_for_blind">{{ __('Duration for Blind Students in Minutes:') }}</label>
                                <input disabled id="duration_for_blind" type="number" disabled placeholder="{{ __('20, 25 or 30 etc') }}" title="Duration for Blind Students in Minutes(20, 25 or 30 etc)" class="form-control" name="duration_for_blind" value="{{ $examination['duration_for_blind'] }}" required autocomplete="duration_for_blind">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            
                <div class="card ">
                    <div class="card-header">
                        <div class="card-title">
                            Examination Questions
                        </div>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        </div>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <table id="questions_table" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Questions</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php $i=0; @endphp
                                @foreach($included_questions as $question)
                                @php $question = (array)$question @endphp
                                <tr>
                                    <td>
                                        <div class="card mb-0">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <label>{{++$i}}. Title: </label> {{$question['subject']}} 
                                                </div>
                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <b>Question Text: </b> {{$question['question_text']}}
                                            </div>
                                            <div class="card-footer">
                                                <div class="row option-row">
                                                    <div class="col-md-12">
                                                        <b>Option A:</b> @if($question['correct_option'] == 'A') <span class="right badge badge-success"><i class="fas fa-check"></i>&nbsp; Correct</span> @endif
                                                        {{$question['option_a']}}
                                                    </div>
                                                </div>
                                                <div class="row option-row">
                                                    <div class="col-md-12">
                                                        <b>Option B:</b> @if($question['correct_option'] == 'B') <span class="right badge badge-success"><i class="fas fa-check"></i>&nbsp; Correct</span> @endif
                                                        {{$question['option_b']}}
                                                    </div>
                                                </div>
                                                @if($question['option_c'])
                                                <div class="row option-row">
                                                    <div class="col-md-12">
                                                        <b>Option C:</b> @if($question['correct_option'] == 'C') <span class="right badge badge-success"><i class="fas fa-check"></i>&nbsp; Correct</span> @endif 
                                                        {{$question['option_c']}}
                                                    </div>
                                                </div>
                                                @endif
                                                @if($question['option_d'])
                                                <div class="row option-row">
                                                    <div class="col-md-12">
                                                        <b>Option D:</b> @if($question['correct_option'] == 'D') <span class="right badge badge-success"><i class="fas fa-check"></i>&nbsp; Correct</span> @endif
                                                        {{$question['option_d']}} 
                                                    </div>
                                                </div>
                                                @endif
                                                @if($question['option_e'])
                                                <div class="row option-row">
                                                    <div class="col-md-12"> 
                                                        <b>Option E:</b> @if($question['correct_option'] == 'E') <span class="right badge badge-success"><i class="fas fa-check"></i>&nbsp; Correct</span> @endif 
                                                        {{$question['option_e']}}
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.card-body -->
                </div>
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
