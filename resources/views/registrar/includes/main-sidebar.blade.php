<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header text-center">
        Registrar Menu
      </li>
      <li class="{{ route('registrar.dashboard') == url()->current() ? 'active' : ''}}">
        <a href="{{ route('registrar.dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="treeview {{ route('registrar.students') == url()->current() || route('registrar.add.student') == url()->current() || route('registrar.import.students') == url()->current() ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-graduation-cap"></i> <span>Students</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('registrar.add.student') }}"><i class="fa fa-arrow-circle-right"></i> Add Student</a></li>
          <li><a href="{{ route('registrar.import.students') }}"><i class="fa fa-arrow-circle-right"></i> Import Students</a></li>
          <li><a href="{{ route('registrar.students') }}"><i class="fa fa-arrow-circle-right"></i> View Students</a></li>
          <li><a href="{{ asset('/uploads/Students_Import_Sheet.xlsx') }}" target="_blank"><i class="fa fa-download"></i> Download Form</a></li>
        </ul>
      </li>

      <li class="{{ route('registrar.subjects') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('registrar.subjects') }}">
          <i class="fa fa-book"></i> <span>Subjects</span>
        </a>
      </li>
    </ul>
  </section>
</aside>