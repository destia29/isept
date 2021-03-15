@extends('templateclunila')

@section('title')
  LCUnila | Our Service
@endsection

@section('main')
	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>Services</span>We serve you<br>The excellent services!</h3>
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
							<li>Service</li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- INNER CONTENT -->
	<div class="inner-content no-padding">
		<div class="container">
			<div class="services padding80">
				<div class="row">
					<div class="col-md-3">
						<div class="service-content text-center">
							<span><i class="fa fa-globe"></i></span>
							<div class="services-content">
								<h2>Professional</h2>
								<p>We are committed to ensure our staffs to work professionally.</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="service-content text-center">
							<span><i class="fa fa-trophy"></i></span>
							<div class="services-content">
								<h2>Qualify</h2>
								<p>We are committed to provide high quality services.</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="service-content text-center">
							<span><i class="fa fa-thumbs-up"></i></span>
							<div class="services-content">
								<h2>Innovative</h2>
								<p>We are always trying to innovate and improve the services we deliver.</p>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="service-content text-center">
							<span><i class="fa fa-life-ring"></i></span>
							<div class="services-content">
								<h2>Great Support</h2>
								<p>We commit to understand your needs and work together to serve you.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-8 col-md-offset-2 text-center">
				<h2>Our Services For You.</h2>
				<p>As a Language Center of Lampung University, we know that our Students and Clients need services especially in learning development and
          language services. So that, we have some services to support, evaluate, and also improve your skills.</p>
			</div>

			<div class="features">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div>
								<img src="images/other/bannerservice_remakefaizdavid.png" class="img-responsive" alt="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="fc-main">
								<div class="feature-content space40">
									<i class="fa fa-graduation-cap"></i>
									<div class="fc-inner">
										<h2>Evaluation Test</h2>
										<p align="justify">We have some evaluation tests to measure your language skills. These are EPT (English Proficiency Test), TOEFL ITP (Institutional Testing Program), etc.</p>
									</div>
								</div>
								<div class="feature-content space40">
									<i class="fa fa-star"></i>
									<div class="fc-inner">
										<h2>Courses</h2>
										<p align="justify">We provide several courses to improve your language skills. These courses focus on improving your speaking, writing, listening and reading skills, even including the ability to be organised and better manage your time during the EPT/TOEFL ITP test.</p>
									</div>
								</div>
								<div class="feature-content space40">
									<i class="fa fa-file"></i>
									<div class="fc-inner">
										<h2>Document Translation</h2>
										<p align="justify">We specialize offer to translate documents to and from multi languages. We have translated many documents for the private sector, including academics, private documents, legal documents, etc. </p>
									</div>
								</div>
								<div class="feature-content space40">
									<i class="fa fa-university"></i>
									<div class="fc-inner">
										<h2>Academic Services</h2>
										<p align="justify">We also provide administrative and advisory services and opportunities for learning development to support the student experience, especially in language services.</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="pattern-bg1 padding40">
				<div class="cta-dark">
					<div class="col-md-12">
						<div class="col-md-9">
							<h3 class="white no-margin"><span>Have some questions or need help?</span></h3>
							<p class="lite-white">Welcome to Language Center of Lampung University, If you have any questions or would like to get more detailed information, please contact us at: (+62) 721 770 844.</p>
						</div>
						<div class="col-md-3">
							<a  href="contactus" class="button btn-lg color2 btn-radius pull-right">Contact Us</a>
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="pricing-table3 pattern-bg2">
			<div class="container">
				<div class="col-md-10 col-md-offset-1">
					<h3 class="heading" align="center">Service Cost of <br>Language Center of Lampung University<span></span></h3>
					<div class="space-top">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Kind of service</th>
									<th>Quantity</th>
									<th>Cost</th>
								</tr>
							</thead>
							<tbody>
              <?php $i=1; ?>
              @foreach($service as $data)
								<tr>
									<td>{{ $i++ }}</td>
									<td>{{ $data->name }}</td>
									<td>{{ $data->quantity }}</td>
									<td>{{ $data->modif_cost }}</td>
								</tr>
              @endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<!-- <div id="stats3" class="parallax-bg1">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="stats3-info">
							<i class="icon-location3"></i>
							<p><span class="count">19</span></p>
							<h2>Services</h2>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="stats3-info">
							<i class="icon-location3"></i>
							<p><span class="count">11150</span></p>
							<h2>Clients</h2>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="stats3-info">
							<i class="icon-photoshop"></i>
							<p><span class="count">4</span></p>
							<h2>Courses</h2>
						</div>
					</div>
					<div class="col-md-3 col-sm-6">
						<div class="stats3-info">
							<i class="icon-bookmark"></i>
							<p><span class="count">14</span></p>
							<h2>Staffs</h2>
						</div>
					</div>
				</div>
			</div>
		</div> -->
	</div>
  @stop

  @section('footer')
    @include('footer-top')
    @include('footer')
    @include('style-switcher')
  @stop
