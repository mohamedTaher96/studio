<header class="main-header">
        <!-- Logo -->
        <a href="http://localhost:8000/admin" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>S</b> A</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>Studio</b> Admin</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              @if (Session::has('الرسائل'))
              <li class="dropdown messages-menu">
                  <a href="http://localhost:8000/admin/messages/" >
                    <i class="fa fa-envelope-o"></i>
                    <span class="label label-danger">{{$unread}}</span>
                  </a>
                </li>
              @endif
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src='{{asset("images/admin/$admin->photo")}}' class="user-image" alt="User Image"> 
                  <span class="hidden-xs">{{$admin->first_name }} </span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src='{{asset("images/admin/$admin->photo")}}' class="img-circle" alt="User Image"> 
                    <p>
                        {{$admin->first_name }} {{$admin->last_name }}
                      <small>عضو منذ {{ \Carbon\Carbon::parse($admin->created_at)->format(' M Y')}}</small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a href="http://localhost:8000/admin/profile" class="btn btn-default btn-flat">الصفحة الشخصية</a>
                    </div>
                    <div class="pull-left">
                      <a href="http://localhost:8000/logout" class="btn btn-default btn-flat">تسجيل خروج </a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>