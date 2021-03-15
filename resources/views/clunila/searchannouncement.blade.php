@extends('templateclunila')

@section('title')
  LCUnila | Search Announcement
@endsection

@section('main')

	<!-- PAGE HEADER -->
	<div class="page_header">
		<div class="page_header_parallax3">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<h3><span>Search Announcement</span>Result for:<br>{{ $search }}</h3>
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
							<li>Announcement</li>
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
				<div class="col-md-9 blog-content">
					<div class="row">
						<div id="blog-mason" class="blog-mason-2col">
              <?php $i=1; ?>
              @foreach($searchannouncement as $data)
							<article class="blogpost bm-item isotope-item">
								<h2 class="post-title-small"><a href="{{ route('announcement.detail', ['id' => $data->id]) }}">{{ $data->title }}</a></h2>
								<div class="post-meta">
									<span><a href="#"><i class="icon-clock2"></i>&nbsp;{{ date('d F Y', strtotime($data->release_date)) }}</a></span>
									<span><a href="#"><i class="icon-user"></i>&nbsp;{{ $data->user->name }}</a></span>
								</div>
								<div class="space30"></div>
								<div class="post-media">
									<img src="{{ route('image_announcement', $data->thumbnail) }}" class="img-responsive" alt="">
								</div>
								<div class="space20"></div>
								<div class="post-excerpt">
									<p>{!! str_limit($data->description, 180, '.....') !!}</p>
								</div>
								<a href="{{ route('announcement.detail', ['id' => $data->id]) }}" class="button btn-xs">Read More&nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
							</article>
              @endforeach
						</div>
					</div>
					<div class="space50"></div>
					<!-- Pagination -->
					<div class="page_nav">
						<!-- <a href="#"><i class="fa fa-angle-left"></i></a>
						<a href="#" class="active">1</a>
						<a href="#">2</a>
						<a href="#">3</a>
						<a class="no-active">...</a>
						<a href="#">9</a>
						<a href="#"><i class="fa fa-angle-right"></i></a> -->

              {{ $searchannouncement->links() }}
					</div>
					<!-- End Pagination -->
				</div>
				<!-- End Content -->
				<!-- Sidebar -->
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
