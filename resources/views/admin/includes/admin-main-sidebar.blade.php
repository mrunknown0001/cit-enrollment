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
    </ul>
  </section>
</aside>