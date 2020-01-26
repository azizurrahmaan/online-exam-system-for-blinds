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

  </ul>
</nav>
