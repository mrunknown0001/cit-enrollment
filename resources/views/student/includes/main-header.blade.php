  <header class="main-header">
    <a href="javascript:void(0)" class="logo">
      <span class="logo-mini"><b>MHS</b></span>
      <span class="logo-lg"><b>Student</b></span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
              <img src="@if(Auth::user()->avatar->name != null) {{ asset('uploads/images/'.Auth::user()->avatar->name) }} @else {{ asset('uploads/avatar.jpg') }} @endif" class="user-image" alt="User Image">
              <span class="hidden-xs">{{ ucwords(Auth::user()->firstname . ' ' . Auth::user()->lastname) }} <i class="fa fa-caret-down"></i></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="@if(Auth::user()->avatar->name != null) {{ asset('uploads/images/'.Auth::user()->avatar->name) }} @else {{ asset('uploads/avatar.jpg') }} @endif" class="img-circle" alt="User Image">
                <p>
                  <small><a href="{{ route('student.upload.profile.image') }}" style="color: white;">Change Avatar</a></small>
                </p>
              </li>
              <li class="user-body">
                <div class="row">
                  <div class="col-md-12">
                    <a href="{{ route('student.change.password') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-key"></i> Password Change</a>
                  </div>
                  <div class="col-md-12">
                    
                  </div>
                </div>
              </li>
              <li class="user-footer">
                <a href="{{ route('logout') }}" class="btn btn-default btn-sm btn-block"><i class="fa fa-sign-out"></i> Logout</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>