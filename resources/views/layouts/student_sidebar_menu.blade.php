<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item ">
        <a href="/" class="nav-link {{(url()->current() == route("home"))?'active':''}}">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
      
      <li class="nav-item ">
        <a href="{{route('students.unattempted_examinations')}}" class="nav-link {{(url()->current() == route("students.unattempted_examinations"))?'active':''}}">
          <i class="fas fa-scroll"></i>
          <p>
            Unattempted Exams <span class="badge badge-danger">{{ ($exam_count == 0)?'':$exam_count }}</span>
          </p>
        </a>
      </li>
      <li class="nav-item ">
        <a href="{{route('students.attempted_examinations')}}" class="nav-link {{(url()->current() == route("students.attempted_examinations"))?'active':''}}">
          <i class="fas fa-scroll"></i>
          <p>
            Attempted Exams
          </p>
        </a>
      </li>
  
    </ul>
  </nav>
  