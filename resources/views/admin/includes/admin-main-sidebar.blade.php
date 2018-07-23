<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">
        Navigation
      </li>
      <li class="{{ route('admin.dashboard') == url()->current() ? 'active' : ''}}">
        <a href="{{ route('admin.dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview {{ route('admin.deans') == url()->current() || route('admin.registrars') == url()->current() || route('admin.cashiers') == url()->current() || route('admin.faculties') == url()->current() ? 'active' : '' }}">
        <a href="javascript:void(0)">
          <i class="fa fa-users"></i> <span>Users</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('admin.deans') }}"><i class="fa fa-circle-o"></i> Deans</a></li>
          <li><a href="{{ route('admin.registrars') }}"><i class="fa fa-circle-o"></i> Registrars</a></li>
          <li><a href="{{ route('admin.cashiers') }}"><i class="fa fa-circle-o"></i> Cashiers</a></li>
          <li><a href="{{ route('admin.faculties') }}"><i class="fa fa-circle-o"></i> Faculties</a></li>
        </ul>
      </li>
      <li class="treeview {{ route('admin.courses') == url()->current() || route('admin.course.majors') == url()->current() ? 'active' : '' }}">
        <a href="javascript:void(0)">
          <i class="fa fa-book"></i> <span>Courses</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('admin.courses') }}"><i class="fa fa-circle-o"></i> View Courses</a></li>
          <li><a href="{{ route('admin.course.majors') }}"><i class="fa fa-circle-o"></i> View Course Majors</a></li>
        </ul>
      </li>
      <li class="{{ route('admin.academic.year') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('admin.academic.year') }}">
          <i class="fa fa-calendar"></i> <span>Academic Year</span>
        </a>
      </li>
      <li class="{{ route('admin.year.level') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('admin.year.level') }}">
          <i class="fa fa-bars"></i> <span>Year Level</span>
        </a>
      </li>
      <li class="{{ route('admin.subjects') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('admin.subjects') }}">
          <i class="fa fa-book"></i> <span>Subjects</span>
        </a>
      </li>
      <li class="{{ route('admin.activity.logs') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('admin.activity.logs') }}">
          <i class="fa fa-history"></i> <span>Activity Logs</span>
        </a>
      </li>
    </ul>
  </section>
</aside>