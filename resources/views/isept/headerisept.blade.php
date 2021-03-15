
    <!--Main Content Start -->
    <section class="content">
    <!-- Header -->
    <header class="top-head container-fluid">
        <button type="button" class="navbar-toggle pull-left">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>

        <!-- Search -->
        <form role="search" class="navbar-left app-search pull-left hidden-xs">
          <input type="text" placeholder="Search..." class="form-control">
          <a href="#"><i class="fa fa-search"></i></a>
        </form>

        <!-- Left navbar -->
        <nav class=" navbar-default" role="navigation">
            <ul class="nav navbar-nav hidden-xs">
                <li class="dropdown">
                  <a data-toggle="dropdown" class="dropdown-toggle" href="#">English <span class="caret"></span></a>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="#">Indonesia</a></li>
                        <li><a href="#">French</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Right navbar -->
            <ul class="nav navbar-nav navbar-right top-menu top-right-menu">
                <!-- Notification -->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="zmdi zmdi-notifications-none"></i>
                        <!-- <span class="badge badge-sm up bg-pink count">3</span> -->
                    </a>
                    <ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
                        <li class="noti-header">
                            <p>Notifications</p>
                        </li>
                        <li>
                            <a href="#">
                                <span class="pull-left"><i class="fa fa-info"></i></span>
                                <span>No Result Found</span>
                            </a>
                        </li>

                        <!-- <li>
                            <a href="#">
                                <span class="pull-left"><i class="fa fa-user-plus fa-2x text-info"></i></span>
                                <span>New user registered<br><small class="text-muted">5 minutes ago</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="pull-left"><i class="fa fa-diamond fa-2x text-primary"></i></span>
                                <span>Use animate.css<br><small class="text-muted">5 minutes ago</small></span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span>
                                <span>Send project demo files to client<br><small class="text-muted">1 hour ago</small></span>
                            </a>
                        </li>

                        <li>
                            <p><a href="#" class="text-right">See all notifications</a></p>
                        </li> -->
                    </ul>
                </li>
                <!-- /Notification -->

                <!-- user login dropdown start-->
                <li class="dropdown text-center">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        @if(Auth::user()->role->role_name == "SA Participant")
                        <img alt="" src="{{ route('eptparticipant.profile_picture', Auth::user()->eptparticipant->profile_picture ) }}" class="img-circle profile-img thumb-sm">
                        @elseif(Auth::user()->role->role_name != "EPT Participant")
                        <img alt="" src="{{ route('adminuserphotoprofile_isept', Auth::user()->adminuser->profile_picture ) }}" class="img-circle profile-img thumb-sm">
                        @endif
                        <span class="username">{{ Auth::user()->name }} </span> <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
                        @if(Auth::user()->role->role_name == "Admin God")
                        <li><a href="{{ url('isept/admingod/myprofile') }}"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="{{ url('isept/admingod/changepassword') }}"><i class="fa fa-key"></i> Change Password</a></li>
                        @elseif(Auth::user()->role->role_name == "Admin EPT")
                        <li><a href="{{ url('isept/adminept/myprofile') }}"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="{{ url('isept/adminept/changepassword') }}"><i class="fa fa-key"></i> Change Password</a></li>
                        @elseif(Auth::user()->role->role_name == "EPT Value Manager")
                        <li><a href="{{ url('isept/eptvaluemanager/myprofile') }}"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="{{ url('isept/eptvaluemanager/changepassword') }}"><i class="fa fa-key"></i> Change Password</a></li>
                        @elseif(Auth::user()->role->role_name == "Admin Dekanat")
                        <li><a href="{{ url('isept/admindekanat/myprofile') }}"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="{{ url('isept/admindekanat/changepassword') }}"><i class="fa fa-key"></i> Change Password</a></li>
                        @elseif(Auth::user()->role->role_name == "SA Participant")
                        <li><a href="{{ url('isept/eptparticipant/myprofile') }}"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="{{ url('isept/eptparticipant/changepassword') }}"><i class="fa fa-key"></i> Change Password</a></li>
                        @endif
                        <li><a href="{{ url('logout') }}"><i class="fa fa-sign-out"></i> Log Out</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
            <!-- End right navbar -->
        </nav>

    </header>
