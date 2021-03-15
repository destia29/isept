
<aside class="col-sm-3 ">
<div class="side-widget space50">
  <h4>Search</h4>
  <form role="form" class="search-widget" action="{{ route('event.asidesearch') }}" method="GET">
    <input class="form-control" type="text" name="searchevent">
    <button type="submit"><i class="fa fa-search"></i></button>
  </form>
</div>
<div class="side-widget space50">
  <h4>Recent Event</h4>
  <ul class="list-unstyled popular-post">
                <?php $i=1; ?>
                @foreach($recentevent as $data)
                <li>
                  <div class="popular-img">
                    <a href="{{ route('event.detail', ['id' => $data->id]) }}"> <img src="{{ route('image_event', $data->thumbnail) }}" height="45px" width="60px" alt=""></a>
                  </div>
                  <div class="popular-desc">
                    <h5> <a href="{{ route('event.detail', ['id' => $data->id]) }}">{{ $data->title }}</a></h5>
                    <span>By {{ $data->user->name }}</span>
                  </div>
                </li>
                @endforeach
  </ul>
</div>
<?php
  $release_date = DB::table('lcevent')->select(DB::raw("date_format(release_date, '%Y-%m') as release_date"))->orderBy("release_date", "DESC")->distinct()->pluck('release_date');
  $article = array();
  foreach ($release_date as $key => $value) {
    $article[$key] = DB::table('lcevent')->select([
        'id',
        'title'
      ])->where('release_date', 'like', $value.'%')->get();
  }
 ?>
<div class="side-widget space50">
  <h4>Archives</h4>
  <div id="accordion" class="panel-group">
    @foreach($release_date as $key => $data)
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="panel-title">
          <a href="#collapseOne{{$key}}" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" aria-expanded="false" style="padding: 0px 0px 10px 0px !important;">{{ date('F, Y', strtotime($data)) }}
            <i class="icon-plus2 pull-right"></i>
          </a>
        </div>
      </div>
      <div id="collapseOne{{$key}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px; padding: 0px !important;">
        <div class="panel-body">
          @foreach($article[$key] as $value)
          <p align="justify">
            <a style="padding-left: 15px;" href="{{ route('event.detail', ['id' => $value->id]) }}">{{ str_limit($value->title, 15, '...') }}</a>
          </p>
          @endforeach
        </div>
      </div>
    </div>
    @endforeach
  </div>
{{--
<div class="side-widget">
  <h4>Tag Cloud</h4>
  <div class="tag-list">
    <a href="#">Design</a>
    <a href="#">Photo</a>
    <a href="#">News</a>
    <a href="#">Fashion</a>
    <a href="#">Marketing</a>
    <a href="#">video</a>
    <a href="#">vector</a>
    <a href="#">Photoshop</a>
  </div>
</div>
--}}
</aside>
