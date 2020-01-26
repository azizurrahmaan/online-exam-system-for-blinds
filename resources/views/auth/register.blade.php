@extends('layouts.app')
@section('title')
Register {{(url()->current() == route("students"))?'Students':'Administrators'}}
@endsection
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
                    <div class="card-title">{{ __('Register') }}</div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    </div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row"> 
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="name" type="text" placeholder="{{ __('Name') }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                                        @if(url()->current() == route("administrators"))
                                            <option value="Administrator" {{ (old('role')=='Administrator')?'selected':'' }}>Administrator</option>
                                        @else
                                            <option value="">--Select Type--</option>
                                            <option value="Non-Blind Student" {{ (old('role')=='Non-Blind Student')?'selected':'' }}>Non-Blind Student</option>
                                            <option value="Blind Student" {{ (old('role')=='Blind Student')?'selected':'' }}>Blind Student</option>
                                        @endif
                                    </select>
    
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input id="password-confirm" type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link {{(url()->current() == route("students"))?'active':''}}" href="#students" data-toggle="tab">Students</a></li>
                        <li class="nav-item"><a class="nav-link {{(url()->current() == route("administrators"))?'active':''}}" href="#administrators" data-toggle="tab">Administrators</a></li>
                    </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <div class="tab-content">
                        <div class="{{(url()->current() == route("students"))?'active':''}} tab-pane" id="students">
                            <table id="students_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $i=0; @endphp
                                    @foreach($students as $student)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$student['name']}}</td>
                                        <td>{{$student['email']}}</td>
                                        <td>{{$student['role']}}</td>
                                        <td>
                                            <a class="right badge badge-primary" href="{{ route('students.edit',['user'=>$student['id']]) }}"><i class="fas fa-edit"></i> Edit</a>
                                            <a class="right badge badge-danger" href="#" data-toggle="modal" data-id="{{$student['id']}}" data-name="{{$student['name']}}" data-email="{{$student['email']}}" data-role="{{$student['role']}}" data-target="#modal-danger"><i class="fas fa-trash-alt"></i> Delete</a>
                                            <form action="{{route('students.delete', ['user' => $student['id']])}}" id="form-{{$student['id']}}" method="POST" hidden>
                                                {{method_field('DELETE')}}
                                                @csrf
                                                <input type="submit" class="right badge badge-danger" value="Delete"/>
                                             </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="{{(url()->current() == route("administrators"))?'active':''}} tab-pane" id="administrators">
                            <table id="students_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php $i=0; @endphp
                                    @foreach($admins as $admin)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>{{$admin['name']}}</td>
                                        <td>{{$admin['email']}}</td>
                                        <td>{{$admin['role']}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Type</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div><!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Student?</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Name:<b> <span id="name-span"></span></b> </p>
          <p>Email:<b> <span id="email-span"></span></b> </p>
          <p>Type:<b> <span id="role-span"></span></b> </p>
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
      $('#students_table, #administrators_table').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
      
      $("[data-target='#modal-danger']").on('click', function(){
          let name = $(this).data('name');
          let email = $(this).data('email');
          let role = $(this).data('role');
          let id = $(this).data('id');
        $("#name-span").text(name);
        $("#email-span").text(email);
        $("#role-span").text(role);
        $("#confirm-delete-button").attr('data-form-id',id);
      })
      $("#confirm-delete-button").on('click', function(){
        $('#form-'+$(this).data('form-id')).submit();
      })
    });
  </script>
@endsection
