@extends('layouts.app')
@section('title','Examinations')
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
                        All Examinations
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
                            <th>Blind Duration</th>
                            <th>Non-Blind Duration</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i=0; @endphp
                            @foreach($examinations as $examination)
                            <tr>
                                <td>{{ ++$i}}</td>
                                <td>{{$examination['name']}}</td>
                                <td>{{$examination['total_questions']}}</td>
                                <td>{{$examination['passing_percentage']}}</td>
                                <td>{{$examination['duration_for_non_blind']}}</td>
                                <td>{{$examination['duration_for_blind']}}</td>
                                <td>
                                    <a href="{{ route('examinations.view',['examination' => $examination]) }}" class="right badge badge-success"> <i class="fas fa-eye"></i> View</a>
                                    @if($examination['total_questions'] != $examination['total_questions_added'])
                                    <a href="{{ route('examinations.add_question',['examination' => $examination]) }}" class="right badge badge-primary"> <i class="fas fa-plus"></i> Add Questions</a>
                                    @endif
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
