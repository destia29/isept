@extends('templateiseptunila')

@section('title')
  ISEPT Unila | My EPT Score
@endsection
@section('navbarisept')
  @include('isept/eptparticipant/navbareptparticipant')
@endsection
@section('mainisept')


<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">My EPT Score</h3>
    </div>
    <div class="row">

      <div class="col-md-6">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">EPT Score List</h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                    @if(empty($myeptscore))
                    <tr>
                      <td colspan="7"><p class="text-center"><img src="{{ asset('images/basic/norecordsfound.png') }}" width="100px"></p></td>
                    </tr>
                    @else
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>Attempt</th>
                                      <th>Test Date</th>
                                      <th>Time</th>
                                      <th>Listening</th>
                                      <th>Structure</th>
                                      <th>Reading</th>
                                      <th>EPT Score</th>
                                  </tr>
                              </thead>

                              <tbody>
                                <?php $i=1; ?>
                                @foreach($myeptscore as $data)
                  								<tr>
                  									<td align="center">{{ $data->attempt }}</td>
                  									<td>{{ date('F d, Y', strtotime($data->ept_date)) }}</td>
                  									<td align="center">{{ date('H:i', strtotime($data->ept_time)) }}</td>
                  									<td align="center">{{ $data->listening_score }}</td>
                  									<td align="center">{{ $data->structure_score }}</td>
                  									<td align="center">{{ $data->reading_score }}</td>
                  									<td align="center">
                                      @if($data->total_score >= 450)
                                          <p style="color:green">{{ $data->total_score }}</p>
                                      @else
                                          <p style="color:red">{{ $data->total_score }}</p>
                                      @endif
                                  </td>
				                        </tr>
                                @endforeach
                              </tbody>
                          </table>

                      </div>
                      @endif
                  </div>
              </div>
          </div>
        <div class="col-sm-6 col-md-6">
            <div class="widget-panel widget-style-1 bg-info" style="background-color:#9980FA">
                <i class="fa fa-trophy"></i>
                <h2 class="m-0 counter text-white">
                  @if(!empty($highest->total_score))
                    {{ $highest->total_score }}
                  @else
                    NaN
                  @endif
                </h2>
                <div class="text-white">
                  @if(!empty($highest->total_score))
                    Your Highest Score
                  @else
                    No Record Highscore
                  @endif
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-6">
            <div class="widget-panel widget-style-1" style="background-color:
                @if($percentage < 0 && $percentage > -10)
                  #f1c40f
                @elseif($percentage < 0 && $percentage < -10)
                  #EF4836
                @elseif($percentage == 0)
                  #00d2d3
                @else
                  #54a0ff
                @endif
                ">
                <i class="zmdi zmdi-equalizer text-success"></i>
                  <h2 class="m-0 text-white"><span class="counter">{{ $percentage }}</span>%</h2>
                <div class="text-white">
                  @if($percentage < 0)
                    Your score has decreased
                  @elseif(empty($highest->total_score))
                    No Record Found
                  @elseif($percentage == 0)
                    No change on your score
                  @else
                    Your score has increased
                  @endif
                </div>
            </div>
        </div>
      </div>
      <div class="col-lg-6">
          <div class="portlet"><!-- /primary heading -->
              <div class="portlet-heading">
                  <h3 class="portlet-title text-dark text-uppercase">
                      Your EPT Score Track
                  </h3>
                  <div class="portlet-widgets">
                      <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                      <span class="divider"></span>
                      <a data-toggle="collapse" data-parent="#accordion1" href="#portlet1"><i class="ion-minus-round"></i></a>
                      <span class="divider"></span>
                      <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div id="portlet1" class="panel-collapse collapse in">
                  <div class="portlet-body">
                    @if($graphic_2 == "[]")
                    <p class="text-center"><img src="{{ asset('images/basic/norecordsfound.png') }}" width="150px"></p>
                    @else
                      <div id="graphic2" style="height: 280px;"></div>
                    @endif
                        <div class="row text-center m-t-30 m-b-30">
                            <div class="col-sm-3 col-xs-6">
                                <h4>
                                  @if(!empty($latest_score->listening_score))
                                    {{ $latest_score->listening_score }}
                                  @else
                                    No Record
                                  @endif
                                </h4>
                                <small class="text-muted">Latest Listening Score</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>
                                  @if(!empty($latest_score->structure_score))
                                    {{ $latest_score->structure_score }}
                                  @else
                                    No Record
                                  @endif
                                </h4>
                                <small class="text-muted">Latest Structure Score</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>
                                  @if(!empty($latest_score->reading_score))
                                    {{ $latest_score->reading_score }}
                                  @else
                                    No Record
                                  @endif
                                </h4>
                                <small class="text-muted">Latest Reading Score</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>
                                  @if(!empty($latest_score->total_score))
                                    {{ $latest_score->total_score }}
                                  @else
                                    No Record
                                  @endif

                                </h4>
                                <small class="text-muted">Latest Total Score</small>
                            </div>
                        </div>
                  </div>
              </div>
          </div> <!-- /Portlet -->

      </div> <!-- end col -->
      <div class="col-lg-6">
          <div class="portlet"><!-- /primary heading -->
              <div class="portlet-heading">
                  <h3 class="portlet-title text-dark text-uppercase">
                      Your EPT Report
                  </h3>
                  <div class="portlet-widgets">
                      <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                      <span class="divider"></span>
                      <a data-toggle="collapse" data-parent="#accordion1" href="#portlet1"><i class="ion-minus-round"></i></a>
                      <span class="divider"></span>
                      <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div id="portlet1" class="panel-collapse collapse in">
                  <div class="portlet-body">
                    @if($graphic_1 == "[]")
                    <p class="text-center"><img src="{{ asset('images/basic/norecordsfound.png') }}" width="150px"></p>
                    @else
                      <div id="graphic1" style="height: 280px;"></div>
                    @endif
                  </div>
              </div>
          </div> <!-- /Portlet -->

      </div> <!-- end col -->

      <div class="col-lg-6">
          <div class="portlet"><!-- /primary heading -->
              <div class="portlet-heading">
                  <h3 class="portlet-title text-dark">
                      Your Last EPT Result
                  </h3>
                  <div class="portlet-widgets">
                      <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                      <span class="divider"></span>
                      <a data-toggle="collapse" data-parent="#accordion1" href="#portlet3"><i class="ion-minus-round"></i></a>
                      <span class="divider"></span>
                      <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div id="portlet3" class="panel-collapse collapse in">
                  <div class="portlet-body">
                    @if($graphic_1 == "[]")
                    <p class="text-center"><img src="{{ asset('images/basic/norecordsfound.png') }}" width="150px"></p>
                    @else
                      <div id="latest_ept_donat" height="300" width="800"></div>
                    @endif
                  </div>
              </div>
          </div>
      </div>

  </div> <!-- end row -->
</div>

@stop
@section('script')
<script type="text/javascript">
  Morris.Bar({
      element: 'graphic1',
      data: {!! $graphic_1 !!},
      xkey: 'y',
      ykeys: ['a', 'b', 'c'],
      labels: ['Listening Score', 'Structure Score', 'Reading Score'],
      gridLineColor: '#eef0f2',
      barSizeRatio: 0.4,
      numLines: 6,
      barGap: 6,
      resize: true,
      hideHover: 'auto',
      barColors: ['#34c73b', '#3960d1', '#00d2d3'],

  });

  Morris.Line({
      element: 'graphic2',
      data: {!! $graphic_2 !!},
      xkey: 'y',
      xLabelFormat: function(date) {
        var months = new Array(7);
        months[0] = "January";
        months[1] = "February";
        months[2] = "March";
        months[3] = "April";
        months[4] = "May";
        months[5] = "June";
        months[6] = "July";
        months[7] = "August";
        months[8] = "September";
        months[9] = "October";
        months[10] = "November";
        months[11] = "December";

          return months[date.getMonth()]+' '+date.getDate()+', '+date.getFullYear();
          },
      xLabels:'day',
      ykeys: ['a'],
      labels: ['Total Score'],
      fillOpacity: 0.6,
      hideHover: 'auto',
      gridLineColor: '#eef0f2',
      lineColors: ['#1e90ff'],
      pointFillColors:['#ffffff'],
      pointStrokeColors: ['#30336b'],
      behaveLikeLine: true,
      resize: true,
      dateFormat: function(date) {
        d = new Date(date);
        return d.getDate()+'-'+(d.getMonth()+1)+'-'+d.getFullYear();
      },
  });

  Morris.Donut({
      element: 'latest_ept_donat',
      data: [
        {label: "Latest Listening Score", value:
        @if(!empty($latest_score->listening_score))
          {!! $latest_score->listening_score !!} },
        @else
          0
        @endif
        {label: "Latest Structure Score", value:
        @if(!empty($latest_score->structure_score))
          {!! $latest_score->structure_score !!} },
        @else
          0
        @endif
        {label: "Latest Reading Score", value:
        @if(!empty($latest_score->reading_score))
          {!! $latest_score->reading_score !!} },
        @else
          0
        @endif
      ],
      colors: ['#34c73b', '#3960d1', '#00d2d3'],
  });
</script>
@endsection

@section('footer')
  @include('isclunila/footerisclunila')
@stop
