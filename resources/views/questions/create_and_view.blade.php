@extends('layouts.app')
@section('title','Question Pool')
@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset("/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">
  <style>
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
                    <div class="card-title">{{ __('Add Question') }}</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('question.save') }}">
                        @csrf
                            <div class="form-group row">
                               <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('Question Title') }}</span>
                                        </div>
                                        <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}"  required autocomplete="subject" autofocus>
                                    </div>
                                    @error('subject')
                                        <span class="invalid-feedback" style="display:inline;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                               </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-12">
                                     <div class="input-group">
                                         <div class="input-group-prepend">
                                             <span class="input-group-text">{{ __('Question Text') }}</span>
                                         </div>
                                         <input id="question_text" type="text" class="form-control @error('question_text') is-invalid @enderror" name="question_text" value="{{ old('question_text') }}"  required autocomplete="question_text" autofocus>
                                     </div>
                                     @error('question_text')
                                        <span class="invalid-feedback" style="display:inline;" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                             </div>
                            
                             <div class="form-group row">
                                <div class="col-md-12">
                                     <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="enable input-group-text" style="font-weight:400;" for="enable-option-a"><input checked disabled type="checkbox" id="enable-option-a"> &nbsp;{{ __('Option A') }}</label>
                                        </div>
                                        <input id="option_a" type="text" class="form-control @error('option_a') is-invalid @enderror" name="option_a" value="{{ old('option_a') }}" required autocomplete="option_a" autofocus>
                                        <div class="input-group-append">
                                            <label class="input-group-text @error('correct_option') red-border @enderror" @error('correct_option') title="Must specify one correct option!" @enderror for="option-a" style="font-weight:400;">
                                                <input type="radio" name="correct_option"  id="option-a" {{ (old('correct_option') == 'A')?'checked':'' }} value="A" required> &nbsp; Correct
                                            </label>
                                        </div>
                                    </div>
                                     @error('option_a')
                                         <span class="invalid-feedback" style="display:inline;" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                </div>
                             </div>

                             <div class="form-group row">
                                <div class="col-md-12">
                                     <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="enable input-group-text" style="font-weight:400;" for="enable-option-b"><input checked disabled type="checkbox" id="enable-option-b"> &nbsp;{{ __('Option B') }}</label>
                                        </div>
                                        <input id="option_b" type="text" class="form-control @error('option_b') is-invalid @enderror" name="option_b" value="{{ old('option_b') }}" required autocomplete="option_b" autofocus>
                                        <div class="input-group-append">
                                            <label class="input-group-text @error('correct_option') red-border @enderror" @error('correct_option') title="Must specify one correct option!" @enderror for="option-b" style="font-weight:400;">
                                                <input type="radio" name="correct_option" id="option-b" value="B" {{ (old('correct_option') == 'B')?'checked':'' }} required> &nbsp; Correct
                                            </label>
                                        </div>
                                    </div>
                                     @error('option_b')
                                         <span class="invalid-feedback" style="display:inline;" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                </div>
                             </div>
                             <div class="form-group row">
                                <div class="col-md-12">
                                     <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="enable input-group-text" style="font-weight:400;" for="enable-option-c"><input class="optional-option-enabler" type="checkbox" {{(old('option_c'))?'checked':''}} id="enable-option-c"> &nbsp;{{ __('Option C') }}</label>
                                        </div>
                                        <input id="option_c" type="text" class="form-control @error('option_c') is-invalid @enderror" name="option_c" value="{{ old('option_c') }}"  {{ (old('option_c'))?'required':'disabled' }} autocomplete="option_c" autofocus>
                                        <div class="input-group-append">
                                            <label class="input-group-text @error('correct_option') red-border @enderror" @error('correct_option') title="Must specify one correct option!" @enderror for="option-c" style="font-weight:400;">
                                                <input type="radio" name="correct_option" id="option-c" value="C" {{ (old('correct_option') == 'C')?'checked':'' }} {{(old('correct_option'))?'':'disabled'}}> &nbsp; Correct
                                            </label>
                                        </div>
                                    </div>
                                     @error('option_c')
                                         <span class="invalid-feedback" style="display:inline;" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                </div>
                             </div>
                             <div class="form-group row">
                                <div class="col-md-12">
                                     <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="enable input-group-text" style="font-weight:400;" for="enable-option-d"><input class="optional-option-enabler" type="checkbox" {{(old('option_d'))?'checked':''}} id="enable-option-d"> &nbsp;{{ __('Option D') }}</label>
                                        </div>
                                        <input id="option_d" type="text" class="form-control @error('option_d') is-invalid @enderror" name="option_d" value="{{ old('option_d') }}" {{ (old('option_d'))?'required':'disabled' }} autocomplete="option_d" autofocus>
                                        <div class="input-group-append">
                                            <label class="input-group-text @error('correct_option') red-border @enderror"  @error('correct_option') title="Must specify one correct option!" @enderror for="option-d" style="font-weight:400;">
                                                <input type="radio" name="correct_option" id="option-d" value="D" {{ (old('correct_option') == 'D')?'checked':'' }} {{(old('correct_option'))?'':'disabled'}}> &nbsp; Correct
                                            </label>
                                        </div>
                                    </div>
                                     @error('option_d')
                                         <span class="invalid-feedback" style="display:inline;" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                </div>
                             </div>
                             <div class="form-group row">
                                <div class="col-md-12">
                                     <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="enable input-group-text" style="font-weight:400;" for="enable-option-e"><input class="optional-option-enabler" type="checkbox" {{(old('option_e'))?'checked':''}} id="enable-option-e"> &nbsp;{{ __('Option E') }}</label>
                                        </div>
                                        <input id="option_e" type="text" class="form-control @error('option_e') is-invalid @enderror" name="option_e" value="{{ old('option_e') }}"  {{ (old('option_e'))?'required':'disabled' }} autocomplete="option_e" autofocus>
                                        <div class="input-group-append">
                                            <label class="input-group-text @error('correct_option') red-border @enderror" @error('correct_option') title="Must specify one correct option!" @enderror for="option-e" style="font-weight:400;">
                                                <input type="radio" name="correct_option" id="option-e" value="E" {{ (old('correct_option') == 'E')?'checked':'' }} {{(old('correct_option'))?'':'disabled'}}> &nbsp; Correct
                                            </label>
                                        </div>
                                    </div>
                                     @error('option_e')
                                         <span class="invalid-feedback" style="display:inline;" role="alert">
                                             <strong>{{ $message }}</strong>
                                         </span>
                                     @enderror
                                </div>
                             </div>

                            
                            <div class="form-group row mb-0">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Add to Pool') }}
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        Question Pool
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
                            @foreach($questions as $question)
                            <tr>
                                <td>
                                    <div class="card mb-0">
                                        <div class="card-header">
                                            <div class="card-title">
                                                <label>{{++$i}}. Title: </label> {{$question['subject']}}
                                            </div>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                                <a class="right badge badge-primary" href="{{ route('question.edit',['question'=>$question]) }}"><i class="fas fa-edit"></i> Edit</a>
                                                <a class="right badge badge-danger" href="#" style="margin-right:5px;" data-toggle="modal" data-id="{{$question['id']}}" data-title="{{$question['subject']}}" data-question-text="{{$question['question_text']}}" data-target="#modal-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                                <form action="{{route('question.delete', ['question' => $question])}}" id="form-{{$question['id']}}" method="POST" hidden>
                                                    {{method_field('DELETE')}}
                                                    @csrf
                                                    <input type="submit" class="right badge badge-danger" value="Delete"/>
                                                </form>
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
<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Question?</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Title:<b> <span id="title-span"></span></b> </p>
          <p>Question Text:<b> <span id="question-text-span"></span></b> </p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          <button type="button" id="confirm-delete-button"  class="btn btn-outline-light">Confirm Delete</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
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
    });
  </script>
@endsection
