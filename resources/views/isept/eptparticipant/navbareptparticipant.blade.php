<!-- Aside Start-->
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="{{ url('isept/eptparticipant/') }}" class="logo-expanded">
          <i></i>
            <img src="{{ asset ('images/basic/iconiseptunila.png') }}" width="21px" height="24px">
            <span class="nav-label">ISEPT</span>
        </a>
    </div>
    <!-- / brand -->

    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            @if (!empty($page) && $page =='index')
            <li class="active">@else<li>@endif
              <a href="{{ url('isept/eptparticipant/') }}"><i class="zmdi zmdi-home"></i> <span class="nav-label">Home</span></a></li>
            @if (!empty($page) && $page =='myeptscore')
            <li class="active">@else<li>@endif
              <a href="{{ url('isept/eptparticipant/myeptscore') }}"><i class="zmdi zmdi-assignment-o"></i> <span class="nav-label">My EPT Score</span></a></li>
            @if (!empty($page) && $page =='myprofile' || $page =='changepassword')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="zmdi zmdi-account"></i> <span class="nav-label">Profile</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='myprofile')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/eptparticipant/myprofile') }}">My Profile</a></li>
                  @if (!empty($page) && $page =='changepassword')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/eptparticipant/changepassword') }}">Change Password</a></li>
                </ul>
            </li>
            @if (!empty($page) && $page =='registerept')
            <li class="active">@else<li>@endif
              <a href="{{ url('isept/eptparticipant/registerept') }}"><i class="zmdi zmdi-sign-in"></i> <span class="nav-label">Register EPT</span></a></li>

            @if (!empty($page) && $page =='supportcenter')
            <li class="active">@else<li>@endif
              <a href="{{ url('isept/eptparticipant/supportcenter') }}"><i class="zmdi zmdi-help"></i> <span class="nav-label">Support Center</span></span></a>
            </li>
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->
