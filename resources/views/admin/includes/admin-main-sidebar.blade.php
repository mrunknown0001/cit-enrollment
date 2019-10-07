<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header text-center">
        Admin Menu
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
          {{-- <li><a href="{{ route('admin.deans') }}"><i class="fa fa-arrow-circle-right"></i> Deans</a></li> --}}
          <li><a href="{{ route('admin.registrars') }}"><i class="fa fa-arrow-circle-right"></i> Registrars</a></li>
          <li><a href="{{ route('admin.cashiers') }}"><i class="fa fa-arrow-circle-right"></i> Cashiers</a></li>
          <li><a href="{{ route('admin.faculties') }}"><i class="fa fa-arrow-circle-right"></i> Faculties</a></li>
        </ul>
      </li>
      <li class="{{ route('admin.students') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('admin.students') }}">
          <i class="fa fa-graduation-cap"></i> <span>Students</span>
        </a>
      </li>
      <li class="{{ route('admin.strands') == url() ? 'active' : '' }}">
        <a href="{{ route('admin.strands') }}">
          <i class="fa fa-book"></i> <span>Strands</span>
        </a>
      </li>
      <li class="treeview {{ route('admin.courses') == url()->current() || route('admin.course.majors') == url()->current() || route('admin.curricula') == url()->current() ? 'active' : '' }}">
        <a href="javascript:void(0)">
          <i class="fa fa-book"></i> <span>Courses</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('admin.courses') }}"><i class="fa fa-arrow-circle-right"></i> View Courses</a></li>
          <li><a href="{{ route('admin.course.majors') }}"><i class="fa fa-arrow-circle-right"></i> View Course Majors</a></li>
          <li><a href="{{ route('admin.curricula') }}"><i class="fa fa-arrow-circle-right"></i> View Course Curricula</a></li>
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
      <li class="{{ route('admin.unit.price.misc') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('admin.unit.price.misc') }}">
          <i class="fa fa-rub"></i> <span>Price &amp; Misc</span>
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