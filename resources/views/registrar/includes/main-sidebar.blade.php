<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">
        Navigation
      </li>
      <li class="{{ route('registrar.dashboard') == url()->current() ? 'active' : ''}}">
        <a href="{{ route('registrar.dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
    </ul>
  </section>
</aside>