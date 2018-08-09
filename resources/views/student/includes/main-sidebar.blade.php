<aside class="main-sidebar">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
        <img src="@if(Auth::user()->avatar->name != null) {{ asset('uploads/images/'.Auth::user()->avatar->name) }} @else {{ asset('uploads/avatar.jpg') }} @endif" class="img-circle" alt="User Image">
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
      <li class="{{ route('student.enrollment') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('student.enrollment') }}">
          <i class="fa fa-file-text-o"></i> <span>Enrollment</span>
        </a>
      </li>
      <li class="{{ route('student.balance') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('student.balance') }}">
          <i class="fa fa-usd"></i> <span>Balance</span>
        </a>
      </li>
      <li class="{{ route('student.payments') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('student.payments') }}">
          <i class="fa fa-money"></i> <span>Payment</span>
        </a>
      </li>
    </ul>
  </section>
</aside>