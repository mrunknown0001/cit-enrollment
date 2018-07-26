<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header text-center">
        Faculty Menu
      </li>
      <li class="{{ route('faculty.dashboard') == url()->current() ? 'active' : ''}}">
        <a href="{{ route('faculty.dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
    </ul>
  </section>
</aside>