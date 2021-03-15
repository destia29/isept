@extends('templateiseptunila')

@section('title')
  ISEPTUnila | EPT Chart
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Welcome !</h3>
    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        EPT for S1/D3 Participant Report
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
                        <div id="s1_ept" style="height: 280px;"></div>
                        <div class="row text-center m-t-30 m-b-30">
                            <div class="col-sm-3 col-xs-6">
                                <h4>{{ $last_ept_part_s1->jumlah }} <i class="fa fa-child"></i></h4>
                                <small class="text-muted">Latest EPT Participant</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>{{ $week_ept_part_s1[0]->jumlah }} <i class="fa fa-child"></i></h4>
                                <small class="text-muted">This Week's EPT Participant</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>{{ $month_ept_part_s1[0]->jumlah }} <i class="fa fa-child"></i></h4>
                                <small class="text-muted">This Month's EPT Participant</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>{{ $year_ept_part_s1[0]->jumlah }} <i class="fa fa-child"></i></h4>
                                <small class="text-muted">This Year's EPT Participant</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /Portlet -->

        </div> <!-- end col -->
@if(!empty( $last_ept_part_s2))
        <div class="col-lg-6">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        EPT for S2/Public Participant Report
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
                        <div id="s2_ept" style="height: 280px;"></div>
                        <div class="row text-center m-t-30 m-b-30">
                            <div class="col-sm-3 col-xs-6">
                                <h4>{{ $last_ept_part_s2->jumlah }} <i class="fa fa-child"></i></h4>
                                <small class="text-muted">Latest EPT Participant</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>{{ $week_ept_part_s2[0]->jumlah }} <i class="fa fa-child"></i></h4>
                                <small class="text-muted">This Week's EPT Participant</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>{{ $month_ept_part_s2[0]->jumlah }} <i class="fa fa-child"></i></h4>
                                <small class="text-muted">This Month's EPT Participant</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>{{ $year_ept_part_s2[0]->jumlah }} <i class="fa fa-child"></i></h4>
                                <small class="text-muted">This Year's EPT Participant</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /Portlet -->

        </div> <!-- end col -->
@endif

    </div> <!-- end row -->


    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="tile-stats white-bg">
                <div class="status">
                    <h3 class="m-t-0"><span class="counter">{{ $latest_pass_percentage }}</span>% <i class="fa fa-child"></i></h3>
                    <p>Latest EPT Participants S1/D3 who passed the EPT</p>
                </div>
                <div class="chart-inline">
                    <span class="dailyEptPart"></span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="tile-stats white-bg">
                <div class="status">
                    <h3 class="m-t-0 counter">{{ $sum_latest_part }}</h3>
                    <p>Daily Registered S1/D3 on the latest EPT</p>
                </div>
                <span class="monthlyRegistered"></span>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="tile-stats white-bg">
                <div class="status">
                    <h3 class="m-t-0"><span class="counter">{{ $latest_pass_percentage_s2 }}</span>% <i class="fa fa-child"></i></h3>
                    <p>Latest EPT Participants S2/Public who passed the EPT</p>
                </div>
                <div class="chart-inline">
                    <span class="dailyEptParts2"></span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="tile-stats white-bg">
                <div class="status">
                    <h3 class="m-t-0 counter">{{ $sum_latest_part_s2 }}</h3>
                    <p>Daily Registered S2/Public on the latest EPT</p>
                </div>
                <span class="monthlyRegistereds2"></span>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-12">

            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        EPT (English Proficiency Test) Schedule
                    </h3>
                    <div class="portlet-widgets">
                        <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                        <span class="divider"></span>
                        <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                        <span class="divider"></span>
                        <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="portlet2" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Test Type</th>
                                        <th>Test Date</th>
                                        <th>Test Time</th>
                                        <th>Registration Date</th>
                                        <th class="text-center">Capacity</th>
                                        <th class="text-center">Participant</th>
                                        <th class="text-center">Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $i=1; $total=0; ?>
                                        @foreach($homepage as $data)
                                        <tr>
                                            <td align="center">{{ $i++ }}</td>
                                            <td>{{ $data->type->type }}</td>
                                            <td>{{ date('d F Y', strtotime($data->ept_date)) }}</td>
                                            <td>{{ $data->ept_time }}</td>
                                            <td>{{ date('d F Y', strtotime($data->registration_date)) }}</td>
                                            <td align="center">
                                              @foreach($data->availableseat as $value)
                                              <?php
                                                $total=$total+$value->room->capacity;
                                                ?>
                                              @endforeach
                                              {{ $total }}
                                              <?php $total=0; ?>
                                              </td>
                                            <td align="center">{{ $data->registerept_participant->count() }}</td>
                                            <td align="center">{{ $data->registerept_registered->count() }}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->
</div>


@stop
@section('script')
<script type="text/javascript">
  var myvalues = [<?php foreach ($daily_pass as $key => $value) {
    echo $value . ',';
  } ?>];

  var monthlyRegistered = [<?php foreach ($monthly_registered as $key => $value) {
    echo $value . ',';
  } ?>];
  $('.dailyEptPart').sparkline(myvalues, {
      type: 'line',
      width: '100%',
      height: '32',
      lineWidth: 2,
      lineColor: '#34c73b',
      fillColor: 'rgba(52, 199, 59, 0.5)',
      highlightSpotColor: '#34c73b',
      highlightLineColor: '#34c73b',
      spotRadius: 3,
  });

  $('.monthlyRegistered').sparkline(monthlyRegistered, {
      type: 'bar',
      barColor: '#3960d1',
      height: '32',
      barWidth: 7,
      barSpacing: 2
  });

  var myvaluess2 = [<?php foreach ($daily_passs2 as $key => $value) {
    echo $value . ',';
  } ?>];

  var monthlyRegistereds2 = [<?php foreach ($monthly_registereds2 as $key => $value) {
    echo $value . ',';
  } ?>];
  $('.dailyEptParts2').sparkline(myvaluess2, {
      type: 'line',
      width: '100%',
      height: '32',
      lineWidth: 2,
      lineColor: '#0984e3',
      fillColor: 'rgba(116, 185, 255,1.0)',
      highlightSpotColor: '#0984e3',
      highlightLineColor: '#0984e3',
      spotRadius: 3,
  });

  $('.monthlyRegistereds2').sparkline(monthlyRegistereds2, {
      type: 'bar',
      barColor: '#badc58',
      height: '32',
      barWidth: 7,
      barSpacing: 2
  });

  Morris.Bar({
      element: 's1_ept',
      data: {!! $ept_s1 !!},
      xkey: 'y',
      ykeys: ['a', 'b', 'c'],
      labels: ['Highest Score', 'Average Score', 'Lowest Score'],
      gridLineColor: '#eef0f2',
      barSizeRatio: 0.4,
      numLines: 6,
      barGap: 6,
      resize: true,
      hideHover: 'auto',
      barColors: ['#34c73b', '#3960d1', '#ff7979']
  });

  Morris.Bar({
      element: 's2_ept',
      data: {!! $ept_s2 !!},
      xkey: 'y',
      ykeys: ['a', 'b', 'c'],
      labels: ['Highest Score', 'Average Score', 'Lowest Score'],
      gridLineColor: '#eef0f2',
      barSizeRatio: 0.4,
      numLines: 6,
      barGap: 6,
      resize: true,
      hideHover: 'auto',
      barColors: ['#34c73b', '#3960d1', '#ff7979']
  });
</script>
@endsection
@section('footer')
  @include('isept/footerisept')
@stop

<?php /*
<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Welcome !</h3>
    </div>

    <div class="row">

        <div class="col-lg-12">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        EPT for S1/D3 Participant Report - Department Level
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
                <!-- ORIGINAL CODE FOR CHARTS -->
                <div id="portlet1" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <!-- <div id="s1_ept" style="height: 280px;"></div>
                        <div class="row text-center m-t-30 m-b-30"> -->
                        <h5 class="portlet-title text-dark text-uppercase">
                            Select Faculty
                        </h5>
                        <div class="row">
                          <div class="col-md-8">
                            <p><strong>Choose EPT Type and Date.</strong></p>
                              <div class="btn-group m-b-10">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <select class="form-control" name="ept_type" id="ept_type" required>
                                            <option selected disabled>- Choose EPT Type -</option>
                                            <!-- @foreach($type as $data)
                                                <option value="{{ $data->id }}">{{ $data->type }}</option>
                                            @endforeach -->
                                        </select>
                                    </div>
                              </div>
                          </div>
                          <div class="col-md-4">
                            <p><strong>Find</strong></p>
                            <div class="btn-group m-b-10">
                              <div class="btn-group dropdown">
                                  <button type="submit" class="btn btn-primary" name="type_file">Find EPT Schedule</button>
                              </div>
                            </div>
                          </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /Portlet -->

        </div> <!-- end col -->


    </div> <!-- end row -->




    <div class="row">

        <div class="col-lg-12">

            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        EPT (English Proficiency Test) Schedule
                    </h3>
                    <div class="portlet-widgets">
                        <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                        <span class="divider"></span>
                        <a data-toggle="collapse" data-parent="#accordion1" href="#portlet2"><i class="ion-minus-round"></i></a>
                        <span class="divider"></span>
                        <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div id="portlet2" class="panel-collapse collapse in">
                    <div class="portlet-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th>Test Type</th>
                                        <th>Test Date</th>
                                        <th>Test Time</th>
                                        <th>Registration Date</th>
                                        <th class="text-center">Capacity</th>
                                        <th class="text-center">Participant</th>
                                        <th class="text-center">Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php $i=1; $total=0; ?>
                                        @foreach($homepage as $data)
                                        <tr>
                                            <td align="center">{{ $i++ }}</td>
                                            <td>{{ $data->type->type }}</td>
                                            <td>{{ date('d F Y', strtotime($data->ept_date)) }}</td>
                                            <td>{{ $data->ept_time }}</td>
                                            <td>{{ date('d F Y', strtotime($data->registration_date)) }}</td>
                                            <td align="center">
                                              @foreach($data->availableseat as $value)
                                              <?php
                                                $total=$total+$value->room->capacity;
                                                ?>
                                              @endforeach
                                              {{ $total }}
                                              <?php $total=0; ?>
                                              </td>
                                            <td align="center">{{ $data->registerept_participant->count() }}</td>
                                            <td align="center">{{ $data->registerept_registered->count() }}</td>
                                        </tr>
                                        @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->
</div>


@stop
@section('script')
<script type="text/javascript">

  Morris.Bar({
      element: 's1_ept',
      data: {!! $ept_s1 !!},
      xkey: 'y',
      ykeys: ['a', 'b', 'c'],
      labels: ['Highest Score', 'Average Score', 'Lowest Score'],
      gridLineColor: '#eef0f2',
      barSizeRatio: 0.4,
      numLines: 6,
      barGap: 6,
      resize: true,
      hideHover: 'auto',
      barColors: ['#34c73b', '#3960d1', '#ff7979']
  });

</script>
*/?>
