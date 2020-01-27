@extends('layouts.app')
@section('title','Create Examinations')
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
                    <div class="card-title">{{ __('Create Examination') }}</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('examination.save') }}">
                        @csrf
                        <div class="row"> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_questions">{{ __('Exam Name:') }}</label>
                                    <input id="name" type="text" placeholder="{{ __('IQ Test') }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="total_questions">{{ __('Total Questions:') }}</label>
                                    <input id="total_questions" type="number" placeholder="{{ __('20, 25 or 30 etc') }}" class="form-control @error('total_questions') is-invalid @enderror" name="total_questions" value="{{ old('total_questions') }}" required autocomplete="total_questions">
                                    @error('total_questions')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="passing_percentage">{{ __('Passing Percentage:') }}</label>
                                    <input id="passing_percentage" type="number" placeholder="{{ __('20, 25 or 30 etc') }}" class="form-control @error('passing_percentage') is-invalid @enderror" name="passing_percentage" value="{{ old('passing_percentage') }}" required autocomplete="passing_percentage">
                                    @error('passing_percentage')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="duration_for_non_blind">{{ __('Duration for Non-Blind Students in Minutes:') }}</label>
                                    <input id="duration_for_non_blind" type="number" placeholder="{{ __('20, 25 or 30 etc') }}" title="Duration for Non-Blind Students in Minutes(20, 25 or 30 etc)" class="form-control @error('duration_for_non_blind') is-invalid @enderror" name="duration_for_non_blind" value="{{ old('duration_for_non_blind') }}" required autocomplete="duration_for_non_blind">
                                    @error('duration_for_non_blind')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="duration_for_blind">{{ __('Duration for Blind Students in Minutes:') }}</label>
                                    <input id="duration_for_blind" type="number" disabled placeholder="{{ __('20, 25 or 30 etc') }}" title="Duration for Blind Students in Minutes(20, 25 or 30 etc)" class="form-control @error('duration_for_blind') is-invalid @enderror" name="duration_for_blind" value="{{ old('duration_for_blind') }}" required autocomplete="duration_for_blind">
                                    @error('duration_for_blind')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <label ></label>
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create') }}
                                    </button>
                                </div>
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

        $("#duration_for_non_blind").on('keyup', function(){
            $("#duration_for_blind").val(Number($(this).val())+30)
        })
    })
</script>
@endsection
