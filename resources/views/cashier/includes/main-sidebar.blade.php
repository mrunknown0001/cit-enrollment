<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header text-center">
        Cashier Menu
      </li>
      <li class="{{ route('cashier.dashboard') == url()->current() ? 'active' : ''}}">
        <a href="{{ route('cashier.dashboard') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li class="{{ route('cashier.payments') == url()->current() ? 'active' : '' }}">
        <a href="{{ route('cashier.payments') }}">
          <i class="fa fa-money"></i> <span>Payments</span>
        </a>
      </li>
    </ul>
  </section>
</aside>