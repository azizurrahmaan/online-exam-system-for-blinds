@extends('layouts.app')
@section('title','Edit Question')
@section('styles')
  <!-- DataTables -->
  <style>
      .red-border{
          border-color: red;
          color: red;
      }
  </style>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('question.update',['question' => $question]) }}">
                        @csrf
                        @method('PATCH')
                            <div class="form-group row">
                               <div class="col-md-12">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">{{ __('Question Title') }}</span>
                                        </div>
                                        <input id="subject" type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject')?old('subject'):$question['subject'] }}"  required autocomplete="subject" autofocus>
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
                                         <input id="question_text" type="text" class="form-control @error('question_text') is-invalid @enderror" name="question_text" value="{{ old('question_text')?old('question_text'):$question['question_text'] }}"  required autocomplete="question_text" autofocus>
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
                                        <input id="option_a" type="text" class="form-control @error('option_a') is-invalid @enderror" name="option_a" value="{{ old('option_a')?old('option_a'):$question['option_a'] }}" required autocomplete="option_a" autofocus>
                                        <div class="input-group-append">
                                            <label class="input-group-text @error('correct_option') red-border @enderror" @error('correct_option') title="Must specify one correct option!" @enderror for="option-a" style="font-weight:400;">
                                                <input type="radio" name="correct_option"  id="option-a" {{ (old('correct_option') == 'A'  || $question['correct_option'] == 'A')?'checked':'' }} value="A" required> &nbsp; Correct
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
                                        <input id="option_b" type="text" class="form-control @error('option_b') is-invalid @enderror" name="option_b" value="{{ old('option_b')?old('option_b'):$question['option_b'] }}" required autocomplete="option_b" autofocus>
                                        <div class="input-group-append">
                                            <label class="input-group-text @error('correct_option') red-border @enderror" @error('correct_option') title="Must specify one correct option!" @enderror for="option-b" style="font-weight:400;">
                                                <input type="radio" name="correct_option" id="option-b" value="B" {{ (old('correct_option') == 'B' || $question['correct_option'] == 'B')?'checked':'' }} required> &nbsp; Correct
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
                                            <label class="enable input-group-text" style="font-weight:400;" for="enable-option-c"><input class="optional-option-enabler" type="checkbox" {{(old('option_c') || $question['option_c'])?'checked':''}} id="enable-option-c"> &nbsp;{{ __('Option C') }}</label>
                                        </div>
                                        <input id="option_c" type="text" class="form-control @error('option_c') is-invalid @enderror" name="option_c" value="{{ old('option_c')?old('option_c'):$question['option_c'] }}"  {{ (old('option_c') || $question['option_c'])?'required':'disabled' }} autocomplete="option_c" autofocus>
                                        <div class="input-group-append">
                                            <label class="input-group-text @error('correct_option') red-border @enderror" @error('correct_option') title="Must specify one correct option!" @enderror for="option-c" style="font-weight:400;">
                                                <input type="radio" name="correct_option" id="option-c" value="C" {{ (old('correct_option') == 'C' || $question['correct_option'] == 'C')?'checked':'' }} {{(old('correct_option') || $question['correct_option'] )?'':'disabled'}}> &nbsp; Correct
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
                                            <label class="enable input-group-text" style="font-weight:400;" for="enable-option-d"><input class="optional-option-enabler" type="checkbox" {{(old('option_d') || $question['option_d'])?'checked':''}} id="enable-option-d"> &nbsp;{{ __('Option D') }}</label>
                                        </div>
                                        <input id="option_d" type="text" class="form-control @error('option_d') is-invalid @enderror" name="option_d" value="{{ old('option_d')?old('option_d'):$question['option_d'] }}" {{ (old('option_d') || $question['option_d'])?'required':'disabled' }} autocomplete="option_d" autofocus>
                                        <div class="input-group-append">
                                            <label class="input-group-text @error('correct_option') red-border @enderror"  @error('correct_option') title="Must specify one correct option!" @enderror for="option-d" style="font-weight:400;">
                                                <input type="radio" name="correct_option" id="option-d" value="D" {{ (old('correct_option') == 'D' || $question['correct_option'] == 'D')?'checked':'' }} {{(old('correct_option') || $question['correct_option'] )?'':'disabled'}}> &nbsp; Correct
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
                                            <label class="enable input-group-text" style="font-weight:400;" for="enable-option-e"><input class="optional-option-enabler" type="checkbox" {{(old('option_e') || $question['option_e'])?'checked':''}} id="enable-option-e"> &nbsp;{{ __('Option E') }}</label>
                                        </div>
                                        <input id="option_e" type="text" class="form-control @error('option_e') is-invalid @enderror" name="option_e" value="{{ old('option_e')?old('option_e'):$question['option_e']}}"  {{ (old('option_e') || $question['option_e'])?'required':'disabled' }} autocomplete="option_e" autofocus>
                                        <div class="input-group-append">
                                            <label class="input-group-text @error('correct_option') red-border @enderror" @error('correct_option') title="Must specify one correct option!" @enderror for="option-e" style="font-weight:400;">
                                                <input type="radio" name="correct_option" id="option-e" value="E" {{ (old('correct_option') == 'E' || $question['correct_option'] == 'E')?'checked':'' }} {{(old('correct_option') || $question['correct_option'] )?'':'disabled'}}> &nbsp; Correct
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
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
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
    });
  </script>
@endsection