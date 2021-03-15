<!-- Aside Start-->
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="{{ url('isept/admindekanat/') }}" class="logo-expanded">
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
              <a href="{{ url('isept/admindekanat/') }}"><i class="zmdi zmdi-home"></i> <span class="nav-label">Home</span></a></li>
            @if (!empty($page) && $page =='neweptscore' || $page =='alleptscore')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="zmdi ion-clipboard"></i> <span class="nav-label">EPT Score</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='neweptscore')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/admindekanat/neweptscore') }}">New EPT Score</a></li>
                  @if (!empty($page) && $page =='alleptscore')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/admindekanat/alleptscore') }}">All EPT Score</a></li>
                </ul>
            </li>

            <!-- chart navbar -->
            @if (!empty($page) && $page =='eptchart' || $page =='eptfaculty'|| $page =='eptdepartment')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="fa fa-bar-chart"></i> <span class="nav-label">EPT Chart</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='eptchart')<li class="active">@else<li>@endif
                    <a href="{{ route('admindekanat.eptchart') }}">University Level</a></li>
                  @if (!empty($page) && $page =='eptfaculty')<li class="active">@else<li>@endif
                    <a href="{{ route('admindekanat.eptfaculty') }}">Faculty Level</a></li>
                    <li class="divider"></li>
                  @if (!empty($page) && $page =='eptdepartment')<li class="active">@else<li>@endif
                    <a href="{{ route('admindekanat.eptdepartment') }}">Department Level</a></li>
                </ul>
            </li>

            @if (!empty($page) && $page =='myprofile' || $page =='changepassword')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="zmdi zmdi-account"></i> <span class="nav-label">Profile</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='myprofile')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/admindekanat/myprofile') }}">My Profile</a></li>
                  @if (!empty($page) && $page =='changepassword')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/admindekanat/changepassword') }}">Change Password</a></li>
                </ul>
            </li>

            @if (!empty($page) && $page =='supportcenter')
            <li class="active">@else<li>@endif
              <a href="{{ url('isept/admindekanat/supportcenter') }}"><i class="zmdi zmdi-help"></i> <span class="nav-label">Support Center</span></span></a>
            </li>
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->
