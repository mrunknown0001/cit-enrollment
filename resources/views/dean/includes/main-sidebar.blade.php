<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">
        Navigation
      </li>
      <li class="{{ route('dean.dashboard') == url()->current() ? 'active' : ''}}">
        <a href="{{ route('dean.dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
    </ul>
  </section>
</aside>