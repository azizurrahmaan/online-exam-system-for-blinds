@extends('layouts.app')
@section('title','Attempted Examinations')
@section('styles')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset("/admin-lte/plugins/datatables-bs4/css/dataTables.bootstrap4.css")}}">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">
                        All Attempted Examinations
                    </div>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <table id="exam_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Total Questions</th>
                            <th>Passing Percentage</th>
                            <th>Duration</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="attempted_exams-table-body">
                            @php $i=0; @endphp
                            @foreach($attempted_examinations as $examination)
                            <tr>
                                <td>{{ ++$i}}</td>
                                <td>{{$examination['name']}}</td>
                                <td>{{$examination['total_questions']}}</td>
                                <td>{{$examination['passing_percentage']}}</td>
                                <td>@if(Auth::user()->role == 'Blind Student'){{$examination['duration_for_blind']}} @elseif(Auth::user()->role == 'Non-Blind Student'){{$examination['duration_for_non_blind']}}@endif</td>
                                <td>
                                    <a href="{{ route('students.attempted_examination_result',['examination'=> $examination->id]) }}" class="right badge badge-success"> <i class="fas fa-eye"></i> View Result</a>
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
<script src="{{ asset('js/textToSpeech.js')}}"></script>
<script>
    $(function () {
        $('#exam_table').DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });

        @if( Auth::user()->role == "Blind Student" )

        
            speakMenu()

            setInterval(() => {
                textToSpeech("Press m to view menu")
            }, 10000);
            var t_pressed_no_of_times = 0;
            var exam_result_url = undefined;
            $('body').keydown(function(event) { 
                var x = event.which || event.keyCode;
                if(x == 84){//t
                    window.speechSynthesis.cancel()
                    if(t_pressed_no_of_times == {{count($attempted_examinations)}}){
                        t_pressed_no_of_times = 0;
                    }
                    let tr_elem = $('#attempted_exams-table-body').children()[t_pressed_no_of_times]
                    textToSpeech("Exam number" + $($(tr_elem).children()[0]).text())
                    textToSpeech("Exam Name" + $($(tr_elem).children()[1]).text())
                    textToSpeech("Total Questions" + $($(tr_elem).children()[2]).text())
                    textToSpeech("Passing paercentage" + $($(tr_elem).children()[3]).text())
                    textToSpeech("Exam Duration" + $($(tr_elem).children()[4]).text())
                    exam_result_url = $($(tr_elem).children()[5]).find('a').attr('href')
                    console.log($($(tr_elem).children()[5]).find('a').attr('href'))
                    textToSpeech("Press R to view results for this exam")
                    textToSpeech("Press T to view next exam")

                    t_pressed_no_of_times++;
                }else if(x == 82){//r
                    window.speechSynthesis.cancel()
                    if(exam_result_url == undefined){
                        textToSpeech("You have not selected any exam to view result")
                        speakMenu()
                    }else{
                        windxow.location=exam_result_url;
                    }
                }else if(x == 72){//h
                    window.speechSynthesis.cancel()
                    window.location="{{route('students.dashboard')}}";
                }else if(x == 76){//l
                    window.speechSynthesis.cancel()
                    $("#logout-form").submit()
                }else if(x == 77){//l
                    window.speechSynthesis.cancel()
                    speakMenu()
                }
            });
        @endif

    })
    function speakMenu(){
        textToSpeech("You are viewing attempted examinations page")
        textToSpeech("You have attempted {{count($attempted_examinations)}} exams")
        textToSpeech("press key t to traverse your attempted examinations")
        textToSpeech("press key h TO go back to home page")
        textToSpeech("press key l to logout of application")
    }
</script>
    
@endsection
