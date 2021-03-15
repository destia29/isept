<header id="header-main">
	<div class="container">
    <div class="navbar yamm navbar-default">
      <div class="navbar-header">

          <a href="{{ url('/') }}" class="navbar-brand"><img src="{{ asset('images/basic/LCUnilaLogoHome.png') }}" width="40%" alt=""/></a>
					<button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle" style="
					    margin-right: 7px !important;
					    margin-top: 16px;
					    margin-bottom: 0px;
					">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          </button>
      </div>

      <!-- CART / SEARCH -->
      <!-- <div class="header-x pull-right">
        <div class="s-search">
          <div class="ss-trigger"><i class="icon-search2"></i></div>
          <div class="ss-content">
            <span class="ss-close icon-cross2"></span>
            <div class="ssc-inner">
				    <form role="form" action="{{ route('home.homesearch') }}" method="GET">
				      <input type="text" placeholder="Type Search text here..." name="searchhome">
				      <button type="submit"><i class="fa fa-search2"></i></button>
				    </form>
            </div>
          </div>
        </div>
      </div> -->

      <div id="navbar-collapse-1" class="navbar-collapse collapse navbar-right">
        <ul class="nav navbar-nav">
          <li class="dropdown yamm-fw">
            <a href="{{ url('/') }}">
              Home
              <div class="arrow-up"></i></div>
            </a>
          </li>

          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
              About Us
              <div class="arrow-up"><i class="fa fa-angle-down"></i></div>
            </a>
            <ul class="dropdown-menu" role="menu">
			  <li><a href="{{ url('lcunilaprofile') }}">LC Unila Profile</a></li>
              <li><a href="{{ url('ourcommitment') }}">Our Commitment</a></li>
              <li><a href="{{ url('visionmission') }}">Vision & Mission</a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
              News
              <div class="arrow-up"><i class="fa fa-angle-down"></i></div>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('announcement') }}">Announcement</a></li>
              <li><a href="{{ url('event') }}">Event</a></li>
            </ul>
          </li>

          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
              Services
              <div class="arrow-up"><i class="fa fa-angle-down"></i></div>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('ourservice') }}">Our Service</a></li>
              <li><a href="{{ url('englishproficiencytest') }}">English Proficiency Test (EPT)</a></li>
              <li><a href="{{ url('ielts') }}">IELTS</a></li>
              <li><a href="{{ url('toeic') }}">TOEIC</a></li>
              <li><a href="{{ url('toeflitp') }}">TOEFL ITP</a></li>
            </ul>
          </li>

          <li class="dropdown yamm-fw">
            <a href="{{ url('contactus') }}">
              Contact Us
              <div class="arrow-up"></i></div>
            </a>
          </li>
					@if($user = Auth::user())
	          <li class="dropdown yamm-fw">
	            <a href="{{ url('logout') }}">Log Out <i class="fa fa-sign-out"></i>
	            </a>
	          </li>
					@else
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
              Login
              <div class="arrow-up"><i class="fa fa-angle-down"></i></div>
            </a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('isept/login') }}">ISEPT</a></li>
            </ul>
          </li>
					@endif
        </ul>
      </div>
    </div>
	</div>
</header>
