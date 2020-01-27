<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block">
      <a href="#" class="nav-link">Home</a>
    </li>
  </ul>

  @if (session('user_registration_success'))
      <div style="padding-top:5px;padding-bottom:5px;"  class="mb-0 alert alert-success alert-dismissible fade show" role="alert">
          {{ session('user_registration_success') }}
          <button style="padding-top:5px" type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif
  @if (session('student_delete_success'))
      <div style="padding-top:5px;padding-bottom:5px;"  class="mb-0 alert alert-success alert-dismissible fade show" role="alert">
          {{ session('student_delete_success') }}
          <button style="padding-top:5px" type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif
  @if (session('student_update_success'))
      <div style="padding-top:5px;padding-bottom:5px;"  class="mb-0 alert alert-success alert-dismissible fade show" role="alert">
          {{ session('student_update_success') }}
          <button style="padding-top:5px" type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif
  @if (session('question_update_success'))
      <div style="padding-top:5px;padding-bottom:5px;"  class="mb-0 alert alert-success alert-dismissible fade show" role="alert">
          {{ session('question_update_success') }}
          <button style="padding-top:5px" type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif
  @if (session('question_delete_success'))
      <div style="padding-top:5px;padding-bottom:5px;"  class="mb-0 alert alert-success alert-dismissible fade show" role="alert">
          {{ session('question_delete_success') }}
          <button style="padding-top:5px" type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif
  @if (session('add_new_qustion_in_exam_success'))
      <div style="padding-top:5px;padding-bottom:5px;"  class="mb-0 alert alert-success alert-dismissible fade show" role="alert">
          {{ session('add_new_qustion_in_exam_success') }}
          <button style="padding-top:5px" type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif
  @if (session('question_count_exceed_error'))
      <div style="padding-top:5px;padding-bottom:5px;"  class="mb-0 alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('question_count_exceed_error') }}
          <button style="padding-top:5px" type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif
  @if (session('questions_added_success'))
      <div style="padding-top:5px;padding-bottom:5px;"  class="mb-0 alert alert-success alert-dismissible fade show" role="alert">
          {{ session('questions_added_success') }}
          <button style="padding-top:5px" type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif
  @if (session('add_new_qustion_in_pool'))
      <div style="padding-top:5px;padding-bottom:5px;"  class="mb-0 alert alert-success alert-dismissible fade show" role="alert">
          {{ session('add_new_qustion_in_pool') }}
          <button style="padding-top:5px" type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
  @endif

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      @guest
          {{-- route('login')  __('Login') Route::has('register') route('register')  __('Register') --}}
      @else
          <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }} &nbsp; <i class="fas fa-sign-out-alt"></i>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
              </form>
          </li>
      @endguest
    </li> 
  </ul>
</nav>