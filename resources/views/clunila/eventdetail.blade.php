@extends('templateclunila')

@section('title')
  LCUnila | Event Detail
@endsection

@section('main')
	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax5">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>Event Detail</span>Find out upcoming events <br> and great events.</h3>
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
							<li>Event - Detail</li>
						</ul>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- INNER CONTENT -->
	<div class="inner-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-9">
					<div class="blog-single">
						<article class="blogpost">
							<h2 class="post-title"><a href="#">{{ $detailevent->title }}</a></h2>
							<div class="post-meta">
								<span><a href="#"><i class="icon-clock2"></i>{{ date('d F Y', strtotime($detailevent->release_date)) }}</a></span>
								<span><a href="#"><i class="icon-user"></i>{{ $detailevent->user->name }}</a></span>
								<span><i class="icon-archive3"></i> <a href="#">Vector</a>, <a href="#">Design</a></span>
								<!-- <span><a href="#"><i class="icon-speech-bubble"></i> 13 Comments</a></span> -->
							</div>
							<div class="space30"></div>
							<!-- Media Gallery -->
                            <div class="post-media">
                                <img src="{{ route('image_event', $detailevent->thumbnail) }}" class="img-responsive" alt="">
                            </div>
							<div class="space30"></div>
							<p>
								{!! $detailevent->description !!}
							</p>
							<!-- <blockquote class="style1">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet. Integer posuere erat a ante.</p>
								<small><b>Author Name</b></small>
							</blockquote> -->
						</article>
					</div>
          
          @include('commentevent')
  				@include('asidesearchevent')
			</div>
		</div>
	</div>

@stop

@section('footer')
  @include('footer-top')
  @include('footer')
  @include('style-switcher')
@stop
