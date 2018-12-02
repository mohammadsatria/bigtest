<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="{{ empty(Auth::user()->img) ?  asset('images/admin-default.png') : asset('uploads/user/'. Auth::id(). '.'. Auth::user()->img) }}" alt="">
            {{ Auth::user()->name }}
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a onclick="LIBS._goToPage('{{ route('user-profile') }}')"> Profile</a></li>
            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
          </ul>
        </li>

      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->