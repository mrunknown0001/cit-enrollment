<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="{{ asset('uploads/images/avatar.jpg') }}" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>{{ ucwords(Auth::user()->firstname . ' ' . Auth::user()->lastname) }}</p>
        <p>{{ Auth::user()->student_number }}</p>
      </div>
    </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header text-center">
        Student Menu
      </li>
      <li class="{{ route('student.dashboard') == url()->current() ? 'active' : ''}}">
        <a href="{{ route('student.dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
    </ul>
  </section>
</aside>