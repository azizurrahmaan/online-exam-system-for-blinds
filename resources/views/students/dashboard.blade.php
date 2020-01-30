@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            
                        </div>
                    @endif
                    You are logged in Student!
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
            textToSpeech("Welcome to Online Multiple Choice test for blind and non blind students")
            textToSpeech("You are on home page")
            textToSpeech("You can do one of the following")
            textToSpeech("press key a to See un-attempted exams")
            textToSpeech("press key b to see attempted exams")
            textToSpeech("press key l to logout of application")
            textToSpeech("the menu will be repeated after 30 seconds")

            setInterval(() => {
                textToSpeech("Welcome to Online Multiple Choice test for blind and non blind students")
                textToSpeech("You are on home page")
                textToSpeech("You can do one of the following")
                textToSpeech("press key a to See un-attempted exams")
                textToSpeech("press key b to see attempted exams")
                textToSpeech("press key l to logout of application")
                textToSpeech("the menu will be repeated after 30 seconds")
            }, 30000);

            $('body').keydown(function(event) { 
                var x = event.which || event.keyCode;
                if(x == 65){
                    window.speechSynthesis.cancel()
                    window.location="{{route('students.unattempted_examinations')}}";
                }else if(x == 66){
                    window.speechSynthesis.cancel()
                    window.location="{{route('students.attempted_examinations')}}";
                }else if(x == 76){
                    window.speechSynthesis.cancel()
                    $("#logout-form").submit()
                }
            });
       @endif
    })
</script>
@endsection
