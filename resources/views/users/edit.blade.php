@extends('layouts.app')
@section('title')
Edit Student
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">{{ __('Edit') }}</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('students.update',['user'=>$user['id']]) }}">
                        @csrf
                        {{ method_field('patch') }}
                            <div class="form-group  row">
                                <div class="col-md-12">
                                    <input id="name" type="text" placeholder="{{ __('Name') }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ (old('name'))?old('name'):$user['name'] }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group  row">
                                <div class="col-md-12">
                                    <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ (old('email'))?old('email'):$user['email'] }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group  row">
                                <div class="col-md-12">
                                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                        <option value="">--Select Type--</option>
                                        <option value="Blind Student" {{ (old('role')=='Blind Student')?'selected':($user['role']=='Blind Student')?'selected':''}}>Blind Student</option>
                                        <option value="Non-Blind Student" {{ (old('role')=='Non-Blind Student')?'selected':($user['role']=='Non-Blind Student')?'selected':''}}>Non-Blind Student</option>
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <input id="reset-password" type="checkbox" name="password_reset"> <label for="reset-password">Change Password</label>
                            </div>
                            <div class="form-group  row">
                                <div class="col-md-12">
                                    <input id="password"  style="display:none;" disabled type="password" placeholder="{{ __('New Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group  row">
                                <div class="col-md-12">
                                    <input id="password-confirm" style="display:none;" disabled type="password" class="form-control" placeholder="{{ __('Confirm New Password') }}" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-12 offset-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update') }}
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
$(function(){
    $('#reset-password').on('change', function(){
        if($(this).is(':checked')){
            $("#password").removeAttr('disabled')
            $("#password-confirm").removeAttr('disabled')
            $("#password").slideDown();
            $("#password-confirm").slideDown();
        }else{
            $("#password").attr('disabled','true')
            $("#password-confirm").attr('disabled','true')
            $("#password").slideUp();
            $("#password-confirm").slideUp();
        }
    })
})
</script>
@endsection
