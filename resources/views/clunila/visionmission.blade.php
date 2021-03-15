@extends('templateclunila')

@section('title')
  LCUnila | Vision and Mission
@endsection

@section('main')
	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>Vision and Mission</span>Why our clients<br>Love our services!</h3>
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
							<li>Vision and Mission</li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="container padding80" id="3">
		<div class="section-about">
			<div class="row">
				<div class="col-md-6">
					<div>
						<img src="images/onepage/8/4.jpg" class="img-responsive" alt="">
					</div>
				</div>
				<div class="col-md-6">
					<div>
						<h3>Vision</h3>
						<p class="lead">Being a Professional and Qualified Language Center.</p>
						<h3>Mission</h3>
            <ul>
              <p>1. Supporting the vision of Unila to become a top ten national university.</p>
              <p>2. Being one of the best language center at the national level of foreign language course.</p>
              <p>3. Increasing the quality of academic human resources Lampung University in language proficiency.</p>
              <p>4. Providing Qualified language course and training.</p>
              <p>5. Establishing cooperation with domestic and foreign language institutions.</p>
            </ul>
            <div class="space20"></div>
						<a href="#" class="button btn-border color2">Contact Us</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- INNER CONTENT -->
	<div class="inner-content no-padding">
		<section id="portfolio-section">
			<div class="container">
  				<h2 class="uppercase text-center">Recent Events</h2>
  				<ul class="filter" data-option-key="filter">
  					<li><a class="selected" href="#filter" data-option-value="*">All</a></li>
  					<li><a class="" href="#filter" data-option-value=".education">Education</a></li>
  					<li><a class="" href="#filter" data-option-value=".interest">Interest</a></li>
  					<li><a class="" href="#filter" data-option-value=".news">News</a></li>
  					<li><a class="" href="#filter" data-option-value=".travel">Travel</a></li>
  				</ul>
  				<div id="portfolio-home" class="isotope home-project-3col">
                    <?php $i=1; ?>
                    @foreach($recenteventvissionmission as $data)
  					<div class="project-item travel news">
  						<div class="project-gal">
  							<img src="{{ route('image_event', $data->thumbnail) }}" class="img-responsive" alt="">
  							<div class="overlay-folio">
  								<div class="hover-box">
  									<div class="hover-zoom">
  										<a class="mp-lightbox zoom" href="{{ route('image_event', $data->thumbnail) }}"><i class="icon-plus2"></i></a>
  										<a class="link" href="portfolio-single-slider.html"><i class="icon-link3"></i></a>
  									</div>
  								</div>
  							</div>
  						</div>
  						<div class="project-info">
  							<h2>{{ $data->title }}</h2>
  							<p>{{ $data->tag }}</p>
  						</div>
                    </div>
                    @endforeach
  					<!-- <div class="project-item illustration print">
  						<div class="project-gal">
  							<img src="images/projects/3.jpg" class="img-responsive" alt="">
  							<div class="overlay-folio">
  								<div class="hover-box">
  									<div class="hover-zoom">
  										<a class="mp-lightbox zoom" href="images/projects/3.jpg"><i class="icon-plus2"></i></a>
  										<a class="link" href="portfolio-single-slider.html"><i class="icon-link3"></i></a>
  									</div>
  								</div>
  							</div>
  						</div>
  						<div class="project-info">
  							<h2>Cras ornare tristique elit</h2>
  							<p>Photoshop</p>
  						</div>
  					</div> -->
  					<!-- <div class="project-item photography web-design">
  						<div class="project-gal">
  							<img src="images/projects/4.jpg" class="img-responsive" alt="">
  							<div class="overlay-folio">
  								<div class="hover-box">
  									<div class="hover-zoom">
  										<a class="mp-lightbox zoom" href="images/projects/4.jpg"><i class="icon-plus2"></i></a>
  										<a class="link" href="portfolio-single-slider.html"><i class="icon-link3"></i></a>
  									</div>
  								</div>
  							</div>
  						</div>
  						<div class="project-info">
  							<h2>Praesent placerat risus quis</h2>
  							<p>UI/UX, Web Design</p>
  						</div>
  					</div>
  					<div class="project-item branding">
  						<div class="project-gal">
  							<img src="images/projects/5.jpg" class="img-responsive" alt="">
  							<div class="overlay-folio">
  								<div class="hover-box">
  									<div class="hover-zoom">
  										<a class="mp-lightbox zoom" href="images/projects/5.jpg"><i class="icon-plus2"></i></a>
  										<a class="link" href="portfolio-single-slider.html"><i class="icon-link3"></i></a>
  									</div>
  								</div>
  							</div>
  						</div>
  						<div class="project-info">
  							<h2>Ut aliquam sollicitudin</h2>
  							<p>Web Development</p>
  						</div>
  					</div>
  					<div class="project-item illustration web-design print">
  						<div class="project-gal">
  							<img src="images/projects/6.jpg" class="img-responsive" alt="">
  							<div class="overlay-folio">
  								<div class="hover-box">
  									<div class="hover-zoom">
  										<a class="mp-lightbox zoom" href="images/projects/6.jpg"><i class="icon-plus2"></i></a>
  										<a class="link" href="portfolio-single-slider.html"><i class="icon-link3"></i></a>
  									</div>
  								</div>
  							</div>
  						</div>
  						<div class="project-info">
  							<h2>Cras ornare tristique</h2>
  							<p>Creative, Web</p>
  						</div>
  					</div>
  					<div class="project-item illustration web-design">
  						<div class="project-gal">
  							<img src="images/projects/8.jpg" class="img-responsive" alt="">
  							<div class="overlay-folio">
  								<div class="hover-box">
  									<div class="hover-zoom">
  										<a class="mp-lightbox zoom" href="images/projects/8.jpg"><i class="icon-plus2"></i></a>
  										<a class="link" href="portfolio-single-slider.html"><i class="icon-link3"></i></a>
  									</div>
  								</div>
  							</div>
  						</div>
  						<div class="project-info">
  							<h2>Aliquam tincidunt risus.</h2>
  							<p>Image Gallery</p>
  						</div>
  					</div>
  					<div class="project-item photography branding">
  						<div class="project-gal">
  							<img src="images/projects/10.jpg" class="img-responsive" alt="">
  							<div class="overlay-folio">
  								<div class="hover-box">
  									<div class="hover-zoom">
  										<a class="mp-lightbox zoom" href="images/projects/10.jpg"><i class="icon-plus2"></i></a>
  										<a class="link" href="portfolio-single-slider.html"><i class="icon-link3"></i></a>
  									</div>
  								</div>
  							</div>
  						</div>
  						<div class="project-info">
  							<h2>Aliquam erat volutpat</h2>
  							<p>Image Gallery</p>
  						</div>
  					</div> -->
  				</div>
  			</div>
  		</section>
    </div>

		<div class="padding50">
			<div class="container">
				<div class="cta-center text-center">
					<div class="row">
						<div class="col-md-12">
							<h2>Wanna see our services? Then goahead</h2>
							<div class="space30"></div>
							<a href="{{ url('ourservice') }}" class="button btn-reveal color2 btn-lg btn-center btn-radius"><i class="fa fa-book"></i><span>Check Now</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
  @stop

  @section('footer')
    @include('footer-top')
    @include('footer')
    @include('style-switcher')
  @stop
