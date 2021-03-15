<!-- Aside Start-->
<aside class="left-panel">

    <!-- brand -->
    <div class="logo">
        <a href="{{ url('isept/adminept/') }}" class="logo-expanded">
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
              <a href="{{ url('isept/adminept/') }}"><i class="zmdi zmdi-home"></i> <span class="nav-label">Home</span></a></li>
            @if (!empty($page) && $page =='eptcertificate')
            <li class="active">@else<li>@endif
              <a href="{{ url('isept/adminept/eptcertificate') }}"><i class="fa fa-certificate"></i> <span class="nav-label">EPT Certificate</span></span></a>
            </li>
            @if (!empty($page) && $page =='eptparticipant' || $page =='findparticipant')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="fa fa-users"></i> <span class="nav-label">EPT Participant</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='eptparticipant')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/adminept/neweptparticipant') }}">New EPT Participant</a></li>
                  @if (!empty($page) && $page =='findparticipant')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/adminept/findeptparticipant') }}">Find EPT Participant</a></li>
                </ul>
            </li>
            @if (!empty($page) && $page =='eptproperties')
            <li class="active">@else<li>@endif
              <a href="{{ url('isept/adminept/eptproperties') }}"><i class="zmdi zmdi-star-outline"></i> <span class="nav-label">EPT Properties</span></span></a>
            </li>
            @if (!empty($page) && $page =='eptschedulelist' || $page =='addneweptschedule'|| $page =='findschedule')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="zmdi zmdi-calendar"></i> <span class="nav-label">EPT Schedule</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='eptschedulelist')<li class="active">@else<li>@endif
                    <a href="{{ url('isept/adminept/eptschedulelist') }}">EPT Schedule List</a></li>
                  @if (!empty($page) && $page =='addneweptschedule')<li class="active">@else<li>@endif
                    <a href="{{ url('isept/adminept/addneweptschedule') }}">Add New EPT Schedule</a></li>
                    <li class="divider"></li>
                  @if (!empty($page) && $page =='findschedule')<li class="active">@else<li>@endif
                    <a href="{{ url('isept/adminept/findeptschedule') }}">Find EPT Schedule</a></li>
                </ul>
            </li>
            @if (!empty($page) && $page =='neweptscore' || $page =='findscore')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="zmdi ion-clipboard"></i> <span class="nav-label">EPT Score</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='neweptscore')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/adminept/neweptscore') }}">New EPT Score</a></li>
                  @if (!empty($page) && $page =='findscore')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/adminept/findeptscore') }}">Find EPT Score</a></li>
                </ul>
            </li>
<!-- EPT CHART BEGIN -->
            @if (!empty($page) && $page =='eptchart' || $page =='eptfaculty'|| $page =='eptdepartment')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="fa fa-bar-chart"></i> <span class="nav-label">EPT Chart</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='eptchart')<li class="active">@else<li>@endif
                    <a href="{{ url('isept/adminept/eptchart') }}">University Level</a></li>
                  @if (!empty($page) && $page =='eptfaculty')<li class="active">@else<li>@endif
                    <a href="{{ url('isept/adminept/eptfaculty') }}">Faculty Level</a></li>
                    <li class="divider"></li>
                  @if (!empty($page) && $page =='eptdepartment')<li class="active">@else<li>@endif
                    <a href="{{ url('isept/adminept/eptdepartment') }}">Department Level</a></li>
                </ul>
            </li>
<!-- EPT CHART ENDED -->

            @if (!empty($page) && $page =='myprofile' || $page =='changepassword')
            <li class="has-submenu active">@else<li class="has-submenu">@endif
              <a href="{{ url('#') }}"><i class="zmdi zmdi-account"></i> <span class="nav-label">Profile</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='myprofile')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/adminept/myprofile') }}">My Profile</a></li>
                  @if (!empty($page) && $page =='changepassword')<li class="active">@else<li>@endif
                  <a href="{{ url('isept/adminept/changepassword') }}">Change Password</a></li>
                </ul>
            </li>
            @if (!empty($page) && $page =='supportcenter')
            <li class="active">@else<li>@endif
              <a href="{{ url('isept/adminept/supportcenter') }}"><i class="zmdi zmdi-help"></i> <span class="nav-label">Support Center</span></span></a>
            </li>
        </ul>
    </nav>

</aside>
<!-- Aside Ends-->
