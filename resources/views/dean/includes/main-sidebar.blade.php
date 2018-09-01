<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header text-center">
        Dean Menu
      </li>
      <li class="{{ route('dean.dashboard') == url()->current() ? 'active' : ''}}">
        <a href="{{ route('dean.dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="{{ route('dean.rooms') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('dean.rooms') }}">
          <i class="fa fa-building"></i> <span>Rooms</span>
        </a>
      </li>
      <li class="{{ route('dean.schedules') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('dean.schedules') }}">
          <i class="fa fa-calendar-check-o"></i> <span>Schedules</span>
        </a>
      </li>
    </ul>
  </section>
</aside>