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
          <li><a href="{{ route('registrar.add.student') }}"><i class="fa fa-circle-o"></i> Add Student</a></li>
          <li><a href="{{ route('registrar.import.students') }}"><i class="fa fa-circle-o"></i> Import Students</a></li>
          <li><a href="{{ route('registrar.students') }}"><i class="fa fa-circle-o"></i> View Students</a></li>
          <li><a href="{{ asset('/uploads/Students_Import_Sheet.xlsx') }}" target="_blank"><i class="fa fa-download"></i> Import Form</a></li>
        </ul>
      </li>
    </ul>
  </section>
</aside>