@extends('templateclunila')

@section('title')
  LCUnila | Announcement Detail
@endsection

@section('main')
	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax4">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>Announcement Detail</span>Take a look!<br>To see our announcements.</h3>
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
							<li>Announcement - Detail</li>
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
							<h2 class="post-title"><a href="#">{{ $detailannouncement->title }}</a></h2>
							<div class="post-meta">
								<span><a href="#"><i class="icon-clock2"></i>{{ date('d F Y', strtotime($detailannouncement->release_date)) }}</a></span>
								<span><a href="#"><i class="icon-user"></i>{{ $detailannouncement->user->name }}</a></span>
								<span><i class="icon-archive3"></i>
                  @foreach($tags as $key => $data)
                    <a href="#">{{ $data }}</a>
                  @if($key < count($tags)-1)
                    ,
                  @endif
                  @endforeach
                </span>
								<!-- <span><a href="#"><i class="icon-speech-bubble"></i> 13 Comments</a></span> -->
							</div>
							<div class="space30"></div>
							<!-- Media Gallery -->
                            <div class="post-media">
                                <img src="{{ route('image_announcement', $detailannouncement->thumbnail) }}" class="img-responsive" alt="">
                            </div>
							<div class="space30"></div>
							<p>
								{!! $detailannouncement->description !!}
                            </p>
							<!-- <blockquote class="style1">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante. Lorem ipsum dolor sit amet. Integer posuere erat a ante.</p>
								<small><b>Author Name</b></small>
							</blockquote> -->
						</article>
					</div>
          @include('commentannouncement')
  				@include('asidesearchannouncement')
			</div>
		</div>
	</div>

@stop

@section('footer')
  @include('footer-top')
  @include('footer')
  @include('style-switcher')
@stop
