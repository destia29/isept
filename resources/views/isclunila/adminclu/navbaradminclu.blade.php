  <!-- Aside Start-->
  <aside class="left-panel">

      <!-- brand -->
      <div class="logo">
          <a href="{{ url('isclunila/adminclu/') }}" class="logo-expanded">
            <i></i>
              <img src="{{ asset ('images/basic/logounila.png') }}" width="21px" height="24px">
              <span class="nav-label">ISLCUnila</span>
          </a>
      </div>
      <!-- / brand -->

      <!-- Navbar Start -->
      <nav class="navigation">
          <ul class="list-unstyled">
              @if (!empty($page) && $page =='index')
              <li class="active">@else<li>@endif
                <a href="{{ url('isclunila/adminclu/') }}"><i class="zmdi zmdi-home"></i> <span class="nav-label">Home</span></a></li>
              @if (!empty($page) && $page =='adminaccountlist' || $page =='addnewadminaccount')
              <li class="has-submenu active">@else<li class="has-submenu">@endif
                <a href="{{ url('#') }}"><i class="zmdi zmdi-accounts-alt"></i> <span class="nav-label">Admin Accounts</span><span class="menu-arrow"></span></a>
                  <ul class="list-unstyled">
                    @if (!empty($page) && $page =='adminaccountlist')<li class="active">@else<li>@endif
                      <a href="{{ url('isclunila/adminclu/adminaccountlist') }}">Admin Account List</a></li>
                      @if (!empty($page) && $page =='addnewadminaccount')<li class="active">@else<li>@endif
                      <a href="{{ url('isclunila/adminclu/addnewadminaccount') }}">Add New Admin Account</a></li>
                  </ul>
              </li>
              @if (!empty($page) && $page =='lcuannouncementlist' || $page =='addnewannouncement')
              <li class="has-submenu active">@else<li class="has-submenu">@endif
                <a href="{{ url('#') }}"><i class="zmdi zmdi-calendar"></i> <span class="nav-label">LCU Announcement</span><span class="menu-arrow"></span></a>
                  <ul class="list-unstyled">
                    @if (!empty($page) && $page =='lcuannouncementlist')<li class="active">@else<li>@endif
                      <a href="{{ url('isclunila/adminclu/lcuannouncementlist') }}">LCU Announcement List</a></li>
                      @if (!empty($page) && $page =='addnewannouncement')<li class="active">@else<li>@endif
                      <a href="{{ url('isclunila/adminclu/addnewannouncement') }}">Add New Announcement</a></li>
                  </ul>
              </li>
              @if (!empty($page) && $page =='lcustaff' || $page =='eptparticipant')
              <li class="has-submenu active">@else<li class="has-submenu">@endif
                <a href="{{ url('#') }}"><i class="fa fa-users"></i> <span class="nav-label">LCU Citizen</span><span class="menu-arrow"></span></a>
                  <ul class="list-unstyled">
                    @if (!empty($page) && $page =='eptparticipant')<li class="active">@else<li>@endif
                      <a href="{{ url('isclunila/adminclu/eptparticipant/find') }}">EPT Participant</a></li>
                      @if (!empty($page) && $page =='lcustaff')<li class="active">@else<li>@endif
                      <a href="{{ url('isclunila/adminclu/lcustaff') }}">LCU Staff</a></li>
                  </ul>
              </li>
              @if (!empty($page) && $page =='lcumessage')
              <li class="active">@else<li>@endif
                <a href="{{ url('isclunila/adminclu/lcumessagelist') }}"><i class="fa fa-envelope"></i> <span class="nav-label">LCU Message</span></a></li>
              @if (!empty($page) && $page =='lcueventlist' || $page =='addnewevent')
              <li class="has-submenu active">@else<li class="has-submenu">@endif
                <a href="{{ url('#') }}"><i class="zmdi zmdi-local-activity"></i> <span class="nav-label">LCU Event</span><span class="menu-arrow"></span></a>
                  <ul class="list-unstyled">
                    @if (!empty($page) && $page =='lcueventlist')<li class="active">@else<li>@endif
                      <a href="{{ url('isclunila/adminclu/lcueventlist') }}">LCU Event List</a></li>
                      @if (!empty($page) && $page =='addnewevent')<li class="active">@else<li>@endif
                      <a href="{{ url('isclunila/adminclu/addnewevent') }}">Add New Event</a></li>
                  </ul>
              </li>
              @if (!empty($page) && $page =='lcuservice' || $page =='neweptscore' || $page =='alleptscore')
              <li class="has-submenu active">@else<li class="has-submenu">@endif
                <a href="{{ url('#') }}"><i class="zmdi zmdi-local-library"></i> <span class="nav-label">LCU Services</span><span class="menu-arrow"></span></a>
                  <ul class="list-unstyled">
                    @if (!empty($page) && $page =='lcuservice')<li class="active">@else<li>@endif
                    <a href="{{ url('isclunila/adminclu/lcuservice') }}">LCU Service List</a></li>
                    @if (!empty($page) && $page =='neweptscore')<li class="active">@else<li>@endif
                    <a href="{{ url('isclunila/adminclu/lcuservice/neweptscore') }}">New EPT Score</a></li>
                    @if (!empty($page) && $page =='alleptscore')<li class="active">@else<li>@endif
                    <a href="{{ url('isclunila/adminclu/lcuservice/alleptscore') }}">All EPT Score</a></li>
                  </ul>
              </li>
              @if (!empty($page) && $page =='eptchart' || $page =='eptfaculty'|| $page =='eptdepartment')
              <li class="has-submenu active">@else<li class="has-submenu">@endif
                <a href="{{ url('#') }}"><i class="fa fa-bar-chart"></i> <span class="nav-label">EPT Chart</span><span class="menu-arrow"></span></a>
                <ul class="list-unstyled">
                  @if (!empty($page) && $page =='eptchart')<li class="active">@else<li>@endif
                    <a href="{{ route('isclunila.adminlcu.eptchart') }}">University Level</a></li>
                  @if (!empty($page) && $page =='eptfaculty')<li class="active">@else<li>@endif
                    <a href="{{ route('isclunila.adminlcu.eptfaculty') }}">Faculty Level</a></li>
                    <li class="divider"></li>
                  @if (!empty($page) && $page =='eptdepartment')<li class="active">@else<li>@endif
                    <a href="{{ route('isclunila.adminlcu.eptdepartment') }}">Department Level</a></li>
                </ul>
              </li>
              @if (!empty($page) && $page =='myprofile' || $page =='changepassword')
              <li class="has-submenu active">@else<li class="has-submenu">@endif
                <a href="{{ url('#') }}"><i class="zmdi zmdi-account"></i> <span class="nav-label">Profile</span><span class="menu-arrow"></span></a>
                  <ul class="list-unstyled">
                    @if (!empty($page) && $page =='myprofile')<li class="active">@else<li>@endif
                    <a href="{{ url('isclunila/adminclu/myprofile') }}">My Profile</a></li>
                    @if (!empty($page) && $page =='changepassword')<li class="active">@else<li>@endif
                    <a href="{{ url('isclunila/adminclu/changepassword') }}">Change Password</a></li>
                  </ul>
              </li>

              @if (!empty($page) && $page =='supportcenter')
              <li class="active">@else<li>@endif
                <a href="{{ url('isclunila/adminclu/supportcenter') }}"><i class="zmdi zmdi-help"></i> <span class="nav-label">Support Center</span></span></a>
              </li>
          </ul>
      </nav>

  </aside>
  <!-- Aside Ends-->
