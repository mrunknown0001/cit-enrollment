  <header class="main-header">
    <a href="javascript:void(0)" class="logo">
      <span class="logo-mini"><b>CIT</b></span>
      <span class="logo-lg"><b>Cashier</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ asset('uploads/images/avatar.jpg') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ ucwords(Auth::user()->firstname . ' ' . Auth::user()->lastname) }} <i class="fa fa-caret-down"></i></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="{{ asset('uploads/images/avatar.jpg') }}" class="img-circle" alt="User Image">
                <p>
                  <small>Cashier Member</small>
                </p>
              </li>
              <li class="user-body">
                <div class="row">
                  <div class="col-md-4">
                    <a href="{{ route('cashier.profile') }}" class="btn btn-default btn-sm"><i class="fa fa-user"></i> Profile</a>
                  </div>
                  <div class="col-md-8">
                    <a href="{{ route('cashier.change.password') }}" class="btn btn-default btn-sm"><i class="fa fa-key"></i> Password Change</a>
                  </div>
                </div>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                </div>
                <div class="pull-right">
                  <a href="{{ route('logout') }}" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Logout</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>