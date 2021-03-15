<!-- Aside Start-->
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="{{ url('islcunila/chiefoftheboard/') }}" class="logo-expanded">
          <i></i>
            <img src="{{ asset ('images/basic/logounila.png') }}" width="29px" height="26px">
            <span class="nav-label">ISLCUnila</span>
        </a>
    </div>
    <!-- / brand -->

    <!-- Navbar Start -->
    <nav class="navigation">
        <ul class="list-unstyled">
            @if (!empty($page) && $page =='index')
            <li class="active">@else<li>@endif
              <a href="{{ url('islcunila/chiefoftheboard/') }}"><i class="zmdi zmdi-home"></i> <span class="nav-label">Home</span></a></li>
            @if (!empty($page) && $page =='neweptscore' || $page =='findeptscore')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="zmdi ion-clipboard"></i> <span class="nav-label">EPT Score</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='neweptscore')<li class="active">@else<li>@endif
                  <a href="{{ url('islcunila/chiefoftheboard/neweptscore') }}">New EPT Score</a></li>
                  @if (!empty($page) && $page =='findeptscore')<li class="active">@else<li>@endif
                  <a href="{{ url('islcunila/chiefoftheboard/findeptscore') }}">Find EPT Score</a></li>
                </ul>
            </li>
            @if (!empty($page) && $page =='eptchart' || $page =='eptfaculty'|| $page =='eptdepartment')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="fa fa-bar-chart"></i> <span class="nav-label">EPT Chart</span><span class="menu-arrow"></span></a>
              <ul class="list-unstyled">
                @if (!empty($page) && $page =='eptchart')<li class="active">@else<li>@endif
                  <a href="{{ route('islcunila.chiefoftheboard.eptchart') }}">University Level</a></li>
                @if (!empty($page) && $page =='eptfaculty')<li class="active">@else<li>@endif
                  <a href="{{ route('islcunila.chiefoftheboard.eptfaculty') }}">Faculty Level</a></li>
                  <li class="divider"></li>
                @if (!empty($page) && $page =='eptdepartment')<li class="active">@else<li>@endif
                  <a href="{{ route('islcunila.chiefoftheboard.eptdepartment') }}">Department Level</a></li>
              </ul>
            </li>
            @if (!empty($page) && $page =='myprofile' || $page =='changepassword')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="zmdi zmdi-account"></i> <span class="nav-label">Profile</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='myprofile')<li class="active">@else<li>@endif
                  <a href="{{ url('islcunila/chiefoftheboard/myprofile') }}">My Profile</a></li>
                  @if (!empty($page) && $page =='changepassword')<li class="active">@else<li>@endif
                  <a href="{{ url('islcunila/chiefoftheboard/changepassword') }}">Change Password</a></li>
                </ul>
            </li>

            @if (!empty($page) && $page =='supportcenter')
            <li class="active">@else<li>@endif
              <a href="{{ url('islcunila/chiefoftheboard/supportcenter') }}"><i class="zmdi zmdi-help"></i> <span class="nav-label">Support Center</span></span></a>
            </li>
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->
