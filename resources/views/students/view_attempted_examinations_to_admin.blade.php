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
                    <div class="card-title">{{ __('Student') }}</div>
                </div>
                <div class="card-body">
                    <div class="row"> 
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
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                        <tbody>
                            @php $i=0; @endphp
                            @foreach($attempted_examinations as $examination)
                            <tr>
                                <td>{{ ++$i}}</td>
                                <td>{{$examination['name']}}</td>
                                <td>{{$examination['total_questions']}}</td>
                                <td>{{$examination['passing_percentage']}}</td>
                                <td>@if($student->role == 'Blind Student'){{$examination['duration_for_blind']}} @elseif($student->role == 'Non-Blind Student'){{$examination['duration_for_non_blind']}}@endif</td>
                                <td>
                                    <a href="{{ route('students.attempted_examination_result_to_admin',['examination'=> $examination->id, 'student' => $student->id]) }}" class="right badge badge-success"> <i class="fas fa-eye"></i> View Result</a>
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
        $('#exam_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });
    })
</script>
@endsection
