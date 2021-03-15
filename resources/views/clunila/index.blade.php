@extends('templateclunila')

@section('title')
  LCUnila | Home
@endsection

@section('main')
<div class="slider-wrap">
  <div class="tp-banner-container">
    <div class="tp-banner" >
      <ul>
        <!-- SLIDE  -->
        <li data-transition="fade" data-slotamount="1" data-masterspeed="1500" data-thumb="" data-delay="13000"  data-saveperformance="off"  data-title="Our Workplace">
          <img src="images/slider/homesliderlcunila.jpg"  alt="kenburns1"  data-bgposition="left center" data-kenburns="on" data-duration="14000" data-ease="Linear.easeNone" data-bgfit="100" data-bgfitend="130" data-bgpositionend="right center">
          <div class="tp-caption customin customout tp-resizeme"
            data-x="left" data-hoffset="60"
            data-y="170"
            data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
            data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
            data-speed="1000"
            data-start="500"
            data-easing="Back.easeInOut"
            data-endspeed="300"
            style="font-size:80px;color:#fff;text-transform:uppercase;font-weight: 800 !important;letter-spacing: 0px;line-height: 120% !important;"
            >Professional <br>
            And Qualified
          </div>
          <div class="tp-caption light_title customin customout tp-resizeme"
            data-x="left" data-hoffset="60"
            data-y="370"
            data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
            data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
            data-speed="1000"
            data-start="700"
            data-easing="Back.easeInOut"
            data-endspeed="300"
            style="font-size:18px;color:#fff;"
            >We are committed to provide a high quality, responsive, and accessible service<br>
             to all organisations and individuals with which we interact.
          </div>
          <a href="{{ url('lcunilaprofile') }}" class="tp-caption small_title  customin customout tp-resizeme"
            data-x="left" data-hoffset="60"
            data-y="450"
            data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;"
            data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
            data-speed="1600"
            data-start="900"
            data-easing="Back.easeInOut"
            data-endspeed="300" style="	background: #000; padding:18px 28px; color: #fff; text-transform: uppercase; border: none;font-size: 13px; letter-spacing: 2px; border-radius: 0px;display: table; transition: .4s; border-radius:5px;">Read More</a>
        </li>
        <!-- SLIDE  -->
        <li data-transition="fade" data-slotamount="7" data-masterspeed="2000" data-saveperformance="on"  data-title="Ken Burns Slide">
          <!-- MAIN IMAGE -->
          <img src="images/slider/2.jpg"  alt="2" data-lazyload="images/slider/2.jpg" data-bgposition="right top" data-kenburns="on" data-duration="12000" data-ease="Power0.easeInOut" data-bgfit="115" data-bgfitend="100" data-bgpositionend="center bottom">
          <!-- LAYERS -->
          <!-- LAYER NR. 1 -->
          <div class="tp-caption small_text lft tp-resizeme rs-parallaxlevel-0"
            data-x="center"
            data-y="210"
            data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
            data-speed="500"
            data-start="1200"
            data-easing="Power3.easeInOut"
            data-splitin="none"
            data-splitout="none"
            data-elementdelay="0.05"
            data-endelementdelay="0.1"
            style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;
            min-height: 0px;
            position: absolute;
            color: #fff;
            text-shadow: none;
            font-weight: 400;
            font-size: 14px;
            line-height: 20px;
            margin: 0px;
            border-width: 0px;
            border-style: none;
            text-transform: uppercase;
            white-space: nowrap;
            letter-spacing: 1.8px;
            "><span>Ready to Serve You</span>
          </div>
          <!-- LAYER NR. 2 -->
          <div class="tp-caption small_text customin tp-resizeme rs-parallaxlevel-0"
            data-x="center"
            data-y="256"
            data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
            data-speed="500"
            data-start="1400"
            data-easing="Power3.easeInOut"
            data-splitin="none"
            data-splitout="none"
            data-elementdelay="0.1"
            data-endelementdelay="0.1"
            style="z-index: 7; max-width: auto; max-height: auto; white-space: nowrap;   width: 60px !important;
            height: 1px !important;
            background: #fff !important;
            ">
            <p class="line white"></p>
          </div>
          <!-- LAYER NR. 3 -->
          <div class="tp-caption finewide_medium_white lfl tp-resizeme rs-parallaxlevel-0 center-align"
            data-x="center"
            data-y="280"
            data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
            data-speed="500"
            data-start="1800"
            data-easing="Power3.easeInOut"
            data-splitin="none"
            data-splitout="none"
            data-elementdelay="0.1"
            data-endelementdelay="0.1"
            style="z-index: 8; max-width: auto; max-height: auto; white-space: nowrap;  color: #222222;
            text-shadow: none;
            font-size: 48px;
            line-height: 50px;
            font-weight: 900;
            background-color: none;
            text-decoration: none;
            font-family:Open Sans, sans-serif;
            text-transform: uppercase;
            border-width: 0px;
            color: #fff;
            text-align:center;
            border-color: transparent;
            border-style: none;
            letter-spacing: 2.5;
            "><span>Language Center <br> Lampung University</span>
          </div>
          <!-- LAYER NR. 4 -->
          <div class="tp-caption small_text customin tp-resizeme rs-parallaxlevel-0"
            data-x="center"
            data-y="405"
            data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
            data-speed="500"
            data-start="2000"
            data-easing="Power3.easeInOut"
            data-splitin="none"
            data-splitout="none"
            data-elementdelay="0.1"
            data-endelementdelay="0.1"
            style="z-index: 7; max-width: auto; max-height: auto; white-space: nowrap;">
            <p class="line white"></p>
          </div>
          <!-- LAYER NR. 5 -->
          <div class="tp-caption small_text lfr tp-resizeme rs-parallaxlevel-0"
            data-x="center"
            data-y="435"
            data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
            data-speed="500"
            data-start="2400"
            data-easing="Power3.easeInOut"
            data-splitin="none"
            data-splitout="none"
            data-elementdelay="0.1"
            data-endelementdelay="0.1"
            style="z-index: 7; max-width: auto; max-height: auto; white-space: nowrap;  position: absolute;
            color: #222222;
            text-shadow: none;
            font-weight: 400;
            font-size: 14px;
            line-height: 20px;
            margin: 0px;
            border-width: 0px;
            font-family:Open Sans, sans-serif;
            text-transform: uppercase;
            white-space: nowrap;
            color: #fff;
            letter-spacing: 1.8px;
            "><span>Get Information about our company's history, service, what we are and what we do.</span>
          </div>
          <!-- LAYER NR. 6 -->
          <a href="{{ url('clunilaprofile') }}" class="tp-caption lfb tp-resizeme rs-parallaxlevel-0"
            data-x="center"
            data-y="490"
            data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
            data-speed="500"
            data-start="2800"
            data-easing="Power3.easeInOut"
            data-splitin="none"
            data-splitout="none"
            data-elementdelay="0.1"
            data-endelementdelay="0.1"
            data-linktoslide="next"
            style="z-index: 12; max-width: auto; max-height: auto; white-space: nowrap;padding:18px 28px;
            color: #fff;
            text-transform: uppercase;
            border: none;
            background:#000;
            font-size: 13px;
            letter-spacing: 2px;
            font-family: Montserrat;
            border-radius: 0px;
            display: table;
            transition: .4s;
            border-radius:5px;">Learn More</a>
        </li>
        <!-- SLIDE  -->
      </ul>
      <div class="tp-bannertimer"></div>
    </div>
  </div>
</div>

		<section id="about-section2">
			<div class="container">
				<div class="col-md-8 col-md-offset-2 text-center">
					<h2 class="uppercase">Welcome to <span class="highlight">LC-Unila</span></h2>
					<p>Welcome to Our Page! Language Center of Lampung University is a technical implementation unit in learning development and language services. </p>
				</div>
				<div class="clearfix space30"></div>
				<div class="about-box">
					<div class="row">
						<div class="col-md-3 col-sm-6">
							<div class="about-post">
								<a href="#" data-link="1" class="active"><i class="fa fa-globe"></i></a>
								<h2>PROFESSIONAL</h2>
								<p>We are committed to ensure our staffs to work professionally.</p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="about-post">
								<a class="" href="#" data-link="2"><i class="fa fa-trophy"></i></a>
								<h2>QUALIFY</h2>
								<p>We are committed to provide high quality services. </p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="about-post">
								<a class="" href="#" data-link="3"><i class="fa fa-thumbs-up"></i></a>
								<h2>INNOVATIVE</h2>
								<p>We are always trying to innovate and improve the services we deliver. </p>
							</div>
						</div>
						<div class="col-md-3 col-sm-6">
							<div class="about-post">
								<a class="" href="#" data-link="4"><i class="fa fa-life-ring"></i></a>
								<h2>GREAT SUPPORT</h2>
								<p>We commit to understand your needs and work together to serve you.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="content-tab">
				<div class="container">
					<div class="tab-cont active" data-tab="1">
						<div class="row">
							<div style="" class="col-md-4 triggerAnimation animated fadeInLeft" data-animate="fadeInLeft">
								<h2>PROFESSIONAL</h2>
								<p align="justify">Language Center of Lampung University realizes that our staffs are the most valuable asset.
                  We are committed to ensure our staffs to work professionally. </p>
                <p align="justify">We continue to organize training and evaluation programs to improve our performance and satisfy our clients. </p>
							</div>
							<div style="" class="col-md-8 triggerAnimation animated fadeInRight" data-animate="fadeInRight">
								<div class="image-content">
									<img src="{{asset('images/dev4.png')}}" alt="">
								</div>
							</div>
						</div>
					</div>
					<div class="tab-cont" data-tab="2">
						<div class="row">
							<div style="" class="col-md-4 triggerAnimation animated fadeInLeft" data-animate="fadeInLeft">
								<h2>QUALIFY</h2>
								<p align="justify">We have decided to make an even stronger commitment to excellence and customer satisfaction by acquiring and implementing an ISO 9001 Quality Management System (QMS),
                  which is published by the International Organization for Standardization.</p>
                <p align="justify">Therefore, we are proud to announce that we have achieved an ISO 9001:2015 Certification through an audit conducted by IAPMO R&amp;T, an ANAB accredited Certification Body.</p>
							</div>
							<div style="" class="col-md-8 triggerAnimation animated fadeInRight" data-animate="fadeInRight">
								<div class="image-content">
									<img src="{{asset('images/dev2.png')}}" alt="">
								</div>
							</div>
						</div>
					</div>
					<div class="tab-cont" data-tab="3">
						<div style="" class="retina-content triggerAnimation animated fadeInUp" data-animate="fadeInUp">
							<h2>INNOVATIVE</h2>
							<p>We are always trying to innovate and improve the service we deliver to our clients.<br>
                We seek and share ideas openly, and encourage diversity of experience and opinion.  </p>
							<img src="{{asset('images/dev3.png')}}" alt="">
						</div>
					</div>
					<div class="tab-cont" data-tab="4">
						<div class="row">
							<div style="" class="col-md-8 triggerAnimation animated fadeInLeft" data-animate="fadeInLeft">
								<div class="image-content">
									<img src="{{asset('images/dev4.png')}}" alt="">
								</div>
							</div>
							<div style="" class="col-md-4 triggerAnimation animated fadeInRight" data-animate="fadeInRight">
								<h2>GREAT SUPPORT</h2>
								<p align="justify">We are committed to provide high quality, responsive and accessible service to all
                  organizations and individuals especially Unila Students with which we interact.</p>
								<p align="justify">We also commit to understand your needs and work together to serve you.
                  We are trying to be the best language center in Lampung Province and National.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

    <div class="container padding70">
      <div class="text-center space40">
        <h2 class="title uppercase">Our Services</h2>
        <p>As a Language Center of Lampung University, we know that our Students and Clients need services especially in<br>learning development and language services. So that, we have some services to support, evaluate, and also improve your skills.</p>
      </div>
      <div class="row">
        <div class="col-sm-4">
          <div class="space90"></div>
          <ul class="features-left">
            <li>
              <i class="fa fa-file"></i>
              <h3>English Proficiency Test</h3>
              <p> EPT is a test provided by University of Lampung which measures English language proficiency.</p>
            </li>
            <li>
              <i class="fa fa-book"></i>
              <h3>English Course</h3>
              <p> We provide some courses focused on improving your speaking, writing, listening and reading skills.</p>
            </li>
            <li>
              <i class="fa fa-graduation-cap"></i>
              <h3>Course for Specific Purpose</h3>
              <p> We also provide some courses for specific purpose, like conversation in English and TOEFL Preparation.</p>
            </li>
          </ul>
        </div>
        <div class="col-sm-4 col-sm-push-4">
          <div class="space90"></div>
          <ul class="features-right">
            <li>
              <i class="fa fa-certificate"></i>
              <h3>Document legalization</h3>
              <p> We provide authentication, legalization, or apostille services of Language Center of Lampung University.</p>
            </li>
            <li>
              <i class="fa fa-university"></i>
              <h3>Academic Service</h3>
              <p> We provide administrative and advisory services and opportunities for learning development to support our clients.</p>
            </li>
              <li>
                <i class="fa fa-files-o"></i>
                <h3>Document Translation</h3>
                <p> We offer to translation services of the documents to and from multi languages. We accept private documents, legal documents, etc. </p>
              </li>
          </ul>
        </div>
        <div class="col-sm-4 col-sm-pull-4">
          <div> <img src="images/other/bannerindexlcuniladavid.png" class="img-responsive center-block" alt=""/> </div>
        </div>
      </div>
    </div>
    <div class="clients container">
      <div class="col-md-8 col-md-offset-2 text-center">
        <h2 class="uppercase">EPT <span class="highlight">Schedule</span></h2>
        <p>Take a look at the EPT test dates table below and find the date that suits you best. </p>
      </div>
      <div class="col-md-6">
        <h4>EPT Schedule for S1/D3</h4>
         <div class="space20"></div>
            <div class="space-top">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Test Date</th>
                    <th align="center">Capacity</th>
                    <th align="center">Registered</th>
                    <th align="center">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i=1; $total=0; ?>
                  @foreach($eptschedules1 as $data)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ date('d F Y', strtotime($data->ept_date)) }}</td>
                      <td align="center">
                        @foreach($data->availableseat as $value)
                        <?php
                          $total=$total+$value->room->capacity;
                          ?>
                        @endforeach
                        {{ $total }}
                      </td>
                      <td style="text-align:center">{{ $data->registerept_participant->count() }}</td>
                      <td>
                          @if($total <= $data->registerept_participant->count())
                              <span class="label label-danger">Full</span>
                          @else
                              <span class="label label-success">Available</span>
                          @endif
                      </td>
                    </tr>
                    <?php $total=0; ?>
                  @endforeach
                </tbody>
              </table>
                <div class="col-md-8 col-md-offset-2 text-center">
                  <p><a href="{{ url('englishproficiencytest') }}">>> See More <<<a></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
          <h4>EPT Schedule for S2/Public</h4>
           <div class="space20"></div>
              <div class="space-top">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Test Date</th>
                      <th align="center">Capacity</th>
                      <th align="center">Registered</th>
                      <th align="center">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $i=1; $total=0; ?>
                    @foreach($eptschedules2 as $data)
                      <tr>
                        <td>{{ $i++ }}</td>
                        <td>{{ date('d F Y', strtotime($data->ept_date)) }}</td>
                        <td align="center">
                          @foreach($data->availableseat as $value)
                          <?php
                            $total=$total+$value->room->capacity;
                            ?>
                          @endforeach
                          {{ $total }}
                        </td>
                        <td style="text-align:center">{{ $data->registerept_participant->count() }}</td>
                        <td>
                            @if($total <= $data->registerept_participant->count())
                                <span class="label label-danger">Full</span>
                            @else
                                <span class="label label-success">Available</span>
                            @endif
                        </td>
                      </tr>
                      <?php $total=0; ?>
                    @endforeach
                  </tbody>
                </table>
                  <div class="col-md-8 col-md-offset-2 text-center">
                    <p><a href="{{ url('englishproficiencytest') }}">>> See More <<<a></p>
                  </div>
              </div>
          </div>
    </div>

		<div class="rw-home container padding0">
			<h3 class="uppercase space40">Recent Events</h3>
			<div class="row">
              <?php $i=1; ?>
              @foreach($recentevent as $data)
				<div class="col-md-4">
					<div class="project-item">
						<div class="project-gal">
							<img src="{{ route('image_event', $data->thumbnail) }}" alt="" class="img-responsive">
							<div class="overlay-folio">
								<div class="hover-box">
									<div class="hover-zoom">
										<a class="mp-lightbox zoom" href="{{ route('image_event', $data->thumbnail) }}"><i class="icon-plus2"></i></a>
										<a class="link" href="{{ route('event.detail', ['id' => $data->id]) }}"><i class="icon-link3"></i></a>
									</div>
								</div>
							</div>
						</div>
						<div class="project-info">
							<h2>{{ $data->title }}</h2>
							<p>{{ $data->tag }}</p>
						</div>
					</div>
				</div>
              @endforeach
			</div>
		</div>

		<div class="space70"></div>

		<div class="parallax-bg2">
			<div id="stats1" class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="stats1-info">
							<i class="fa fa-university"></i>
							<p class="white"><span class="count count1">{{ $lcservice }}</span></p>
							<h2 class="white">Services</h2>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="stats1-info">
							<i class="fa fa-users"></i>
							<p class="white"><span class="count count1">{{ $lceptparticipant }}</span></p>
							<h2 class="white">Clients</h2>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="stats1-info">
							<i class="fa fa-book"></i>
							<p class="white"><span class="count count1">4</span></p>
							<h2 class="white">Courses</h2>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="stats1-info">
							<i class="fa fa-user"></i>
							<p class="white"><span class="count count1">{{ $lcstaff }}</span></p>
							<h2 class="white">Staffs</h2>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container padding30">
			<div class="row">
				<div class="col-md-6">
					<h4 class="uppercase space30">What our clients say?</h4>
					<div class="testimonial-box">
						<div id="testimonial" class="owl-carousel">
							<div class="quote-info">
								<img src="images/quote/1.jpg" class="img-responsive" alt="">
								<p>I am very pleased with the service and the results produced! With Language Center's help, I have gained the good EPT score for graduate from my university! Thanks again for all your encouragement given to me during my period of study at Language Center of Unila!</p>
								<h2>David Billie</h2>
							</div>
							<div class="quote-info">
								<img src="images/quote/2.jpg" class="img-responsive" alt="">
								<p>I am very pleased with the service and the results produced! With Language Center's help, I have gained the good EPT score for graduate from my university! Thanks again for all your encouragement given to me during my period of study at Language Center of Unila!</p>
								<h2>Katey Thane</h2>
							</div>
							<div class="quote-info">
								<img src="images/quote/3.jpg" class="img-responsive" alt="">
								<p>I am very pleased with the service and the results produced! With Language Center's help, I have gained the good EPT score for graduate from my university! Thanks again for all your encouragement given to me during my period of study at Language Center of Unila!</p>
								<h2>Wally Buddy</h2>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<h4 class="uppercase space30">4 Things You Should Know About LC Unila</h4>
					<div class="panel-group" id="accordion-e1">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseOne">
									Achieved an ISO 9001:2015 by IAPMO R&amp;T
									<span class="fa fa-chevron-down"></span>
									</a>
								</h4>
							</div>
							<div id="collapseOne" class="panel-collapse collapse in">
								<div class="panel-body">
									<div class="row">
										<p align="justify">We have achieved an ISO 9001:2015, Quality Management System Certificate Certification through an audit conducted by IAPMO R&amp;T, an ANAB accredited Certification Body.
                    Therefore, We are committed to provide a high quality, responsive and accessible service to all the organisations and individuals especially Unila Students with which we interact.</p>
									</div>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseTwo">
									Developing Management Information System Services
									<span class="fa fa-chevron-right"></span>
									</a>
								</h4>
							</div>
							<div id="collapseTwo" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">We have been improving our management system and English test with using web based technologies. These technologies include Computer Based Test (CBT), Information System of English Proficieny Test (ISEPT), etc.</p>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseTheree">
									Established in 2014
									<span class="fa fa-chevron-right"></span>
									</a>
								</h4>
							</div>
							<div id="collapseTheree" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">Language Center of Lampung University has been established through the Decree of the Ministry of Education and Culture of the Republic of Indonesia Number: 1350/UN26/KP/2014 on 18 August 2014. Language Center is a technical implementation unit in learning development and language services.</p>
								</div>
							</div>
						</div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-e1" href="#collapseFour">
									Providing Excellence Services
									<span class="fa fa-chevron-right"></span>
									</a>
								</h4>
							</div>
							<div id="collapseFour" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">We have some services to make sure our vision and mission are successful, these services include conducting TOEFL ITP, ETP, translating files to multi languages, English course, Indonesian Language course, conversation class, and academic services.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container home-blog padding30">
			<div class="text-center space40">
				<h2 class="title uppercase">Latest Announcement</h2>
				<p>Take a look! Don't miss LC Unila's announcements.</p>
			</div>
			<div class="row">
              <?php $i=1; ?>
              @foreach($recentannouncement as $data)
				<div class="col-md-4">
					<div class="hb-info text-center">
						<div class="hb-thumb">
							<img src="{{ route('image_announcement', $data->thumbnail) }}" class="img-responsive" alt="">
							<div class="date-meta">
								{{ date('M', strtotime($data->release_date)) }}<span>{{ date('d', strtotime($data->release_date)) }}</span>{{ date('Y', strtotime($data->release_date)) }}
							</div>
						</div>
						<h4><a href="{{ route('announcement.detail', ['id' => $data->id]) }}">{{ $data->title }}</a></h4>
                        <p>{!! str_limit($data->description, 145, '.....') !!}</p>
						<a href="{{ route('announcement.detail', ['id' => $data->id]) }}" class="readmore">Read more...</a>
					</div>
				</div>
              @endforeach
			</div>
		</div>
@stop

@section('footer')
  @include('footer-top')
  @include('footer')
  @include('style-switcher')
@stop
