@extends('templateclunila')

@section('title')
  LCUnila | Search Result
@endsection

@section('main')

<!-- PAGE HEADER -->
<div class="page_header">
  <div class="page_header_parallax4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h3><span>Search Result</span>Result for: {{ $src }}<br>Here, what you are looking for</h3>
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
            <li>Search</li>
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
        <?php $i=1; ?>
        @foreach($searchhome as $data)
        <article class="blogpost">
          <h2 class="post-title"><a href="{{ route('event.detail', ['id' => $data->id]) }}">{{ $data->title }}</a></h2>
          <div class="post-meta">
              <span><a href="#"><i class="icon-clock2"></i>&nbsp;{{ date('d F Y', strtotime($data->release_date)) }}</a></span>
              <span><a href="#"><i class="icon-user"></i>&nbsp;{{ $data->user->name }}</a></span>
              <span><i class="icon-archive3"></i> <a href="#">&nbsp;Illustration</a>, <a href="#">Branding</a></span>
          </div>
          <div class="space20"></div>
          <div class="post-media">
              <img src="{{ route('image_event', $data->thumbnail) }}" class="img-responsive" alt="">
          </div>
          <div class="space20"></div>
          <div class="post-excerpt">
              <p>{!! str_limit($data->description, 200, '.....') !!}</p>
          </div>
          <a href="{{ route('event.detail', ['id' => $data->id]) }}" class="button btn-xs">Read More&nbsp;&nbsp;<i class="fa fa-angle-right"></i></a>
        </article>
        <div class="blog-sep"></div>
        @endforeach
        <div class="space50"></div>
        <!-- Pagination -->
            <div class="page_nav">
                {{ $searchhome->links() }}
	        </div>
	   <!-- End Pagination -->
       </div>
      <!-- End Content -->
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
