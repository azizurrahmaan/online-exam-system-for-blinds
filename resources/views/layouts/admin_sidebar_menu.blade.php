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
      <a href="/students" class="nav-link {{(url()->current() == route("students"))?'active':''}}">
        <i class="nav-icon fas fa-user-graduate"></i>
        <p>
          Students
        </p>
      </a>
    </li>

    <li class="nav-item ">
      <a href="/administrators" class="nav-link {{(url()->current() == route("administrators"))?'active':''}}">
        <i class="nav-icon fas fa-users"></i>
        <p>
          Administrators
        </p>
      </a>
    </li>

    <li class="nav-item ">
      <a href="/questions" class="nav-link {{(url()->current() == route("questions"))?'active':''}}">
        <i class="fas fa-scroll"></i>
        <p>
          Question Pool
        </p>
      </a>
    </li>

    <li class="nav-item has-treeview {{(url()->current() == route("examinations.create"))?'menu-open':''}}">
      <a href="#" class="nav-link">
        <i class="fas fa-file-alt"></i>
        <p>
          Examinations
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item">
          <a href="/examinations/create" class="nav-link {{(url()->current() == route("examinations.create"))?'active':''}}">
            <i class="fa fa-plus nav-icon"></i>
            <p>Create</p>
          </a>
        </li>
      </ul>
    </li>

  </ul>
</nav>
