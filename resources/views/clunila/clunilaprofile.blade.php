@extends('templateclunila')

@section('title')
  LCUnila | Our Profile
@endsection

@section('main')


	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>Our Profile</span>Language Center <br>Lampung University</h3>
					</div>
				</div>
			</div>
		</div>
		<div class="bcrumb-wrap">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<ul class="bcrumbs">
							<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
							<li><a href="#">About Us</a></li>
							<li>CL Unila Profile</li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="inner-content">
		<div class="container">

			<!-- ABOUT -->
			<div class="section-about space100">
				<div class="row">
					<div class="col-md-6">
						<div>
							<img src="images/other/2.jpg" class="img-responsive" alt="">
						</div>
					</div>
					<div class="col-md-6">
						<div>
							<h3>Who We Are &amp; What We Do</h3>
  							<p align="justify"> Language Center of Lampung University or popularly known as Unit Pelaksana Teknis (UPT) is one of UPT owned Unila and has been established through the Decree of the Ministry of Education and Culture of the Republic of Indonesia Number: 1350/UN26/KP/2014 on 18 August 2014. Language Center is a technical implementation unit in learning development and language services. Language Center of Unila has the task of carrying in learning development, language services and language skills test.</p>
						</div>
					</div>
				</div>
			</div>

			<!-- SERVICES -->
			<div class="section-services2 space40">
    			<div class="text-center space40">
    				<h2 class="title uppercase">Meet our Team</h2>
    				<p>Our team members take a great pride in being a part of the LC Unila,<br>advancing our dedication to the development of language learning and services.</p>
    			</div>
    			<div class="team-box">
    				<div class="container">
    					<div id="home-team" class="owl-carousel owl-theme">
                            <?php $i=1; ?>
                            @foreach($staff as $data)
    						<div class="item">
    							<div class="staff-img">
								    <img src="{{ route('clunilaphotoprofile', $data->picture) }}" height="245px" width="226px" alt="">
    								<div class="team-inner">
    									<ul class="team-social">
    										<li><a class="facebook" target="_blank" href="{{ $data->facebook }}"><i class="fa fa-facebook"></i></a></li>
    										<li><a class="twitter" target="_blank" href="{{ $data->twitter }}"><i class="fa fa-twitter"></i></a></li>
    										<li><a class="google" target="_blank" href="{{ $data->googleplus }}"><i class="fa fa-google-plus"></i></a></li>
    										<li><a class="instagram" target="_blank" href="{{ $data->instagram }}"><i class="fa fa-instagram"></i></a></li>
    									</ul>
    								</div>
    							</div>
    							<h2>{{ $data->name }}</h2>
    							<span>{{ $data->position }}</span>
    						</div>
                            @endforeach
    					</div>
    				</div>
    			</div>
			</div>

			<!-- INFO / SKILLS -->
			<div class="section-info space50">
				<div class="col-md-6">
					<h4>4 Things You Should Know About CL Unila</h4>
					<div class="space30"></div>
					<div class="panel-group" id="accordion">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne1">
									Achieved an ISO 9001:2015 by IAPMO R&amp;T
									<span class="fa fa-plus"></span>
									</a>
								</h4>
							</div>
							<div id="collapseOne1" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">We have achieved an ISO 9001:2015, Quality Management System Certificate Certification through an audit conducted by IAPMO R&amp;T, an ANAB accredited Certification Body.
                  Therefore, We are committed to provide a high quality, responsive and accessible service to all the organisations and individuals especially Unila Students with which we interact.</p>
                </div>
							</div>
						</div>
						<div class="clearfix space10"></div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo1">
									Developing Management Information System Services
									<span class="fa fa-plus"></span>
									</a>
								</h4>
							</div>
							<div id="collapseTwo1" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">We also has been improving our management system and english test with using web based technologies. These technologies include Computer Based Test (CBT), Information System of English Proficieny Test (ISEPT), etc.</p>
								</div>
							</div>
						</div>
						<div class="clearfix space10"></div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree1">
									Established in 2014
									<span class="fa fa-plus"></span>
									</a>
								</h4>
							</div>
							<div id="collapseThree1" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">Language Center of Lampung University has been established through the Decree of the Ministry of Education and Culture of the Republic of Indonesia Number: 1350/UN26/KP/2014 on 18 August 2014. Language Center of Unila is a technical implementation unit in learning development and language services.</p>
								</div>
							</div>
						</div>
						<div class="clearfix space10"></div>
						<div class="panel panel-default">
							<div class="panel-heading">
								<h4 class="panel-title">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour1">
									Providing Excellence Services
									<span class="fa fa-plus"></span>
									</a>
								</h4>
							</div>
							<div id="collapseFour1" class="panel-collapse collapse">
								<div class="panel-body">
									<p align="justify">We have some services to make sure our vision and mission are succeed, these services included conducting TOEFL ITP, ETP, translating files to multi languages, english course, indonesian language course, conversation class, and academic services.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="block-heading">
						<h3><span>Unila Profile</span></h3>
					</div>
					<!-- YouTube -->
					<div class="video">
						<iframe src="https://www.youtube.com/embed/42NrNAP-Ayk" height="360" width="640">
						</iframe>
					</div>
					<!-- End YouTube -->
				</div>
				<div class="clearfix"></div>
			</div>

			<!-- TESTIMONIALS -->
			<section id="section-testimonials">
				<div class="container">
					<h2 class="content-head text-center">What our clients say?</h2>
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
			</section>
		</div>
	</div>

@stop

@section('footer')
  @include('footer-top')
  @include('footer')
  @include('style-switcher')
@stop
