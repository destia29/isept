@extends('templateiseptunila')

@section('title')
  ISEPT Unila | EPT Chart
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">EPT Chart Report</h3>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        EPT Participant Report - Faculty Level
                        <?php if (isset($ket)): ?>
                          <?php if ($ket["date"] != ""): ?>
                            <br> Date {{ $ket["date"] }}
                          <?php endif ?>
                          <?php if ($ket["searchscore"] != ""): ?>
                            <br> Score Range {{ $ket["searchscore"] }}
                          
                          <?php endif ?>
                      <?php endif ?>
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
                        <?php if ($raw_filter["epttype"] == "" || $raw_filter["epttype"] == 1): ?>
                          <h4>D3 / S1</h4>
                          <div id="s1_ept" style="height: 280px;"></div>
                        <?php endif ?>
                        <?php if ($raw_filter["epttype"] == "" || $raw_filter["epttype"] == 2): ?>
                          <h4>Post Graduate/Public</h4>
                          <div id="s2_ept" style="height: 280px;"></div>
                        <?php endif ?>

                        <?php if (isset($raw_filter)) : ?>
                          <?php if ($raw_filter['date_start'] != "" && $raw_filter['date_end'] != "" && $raw_filter["searchscore_data"] != ""): ?>
                          <a href="{{ route('adminept.eptfaculty.pdf', [
                              'ept_date_start'    => $raw_filter['date_start'],
                              'ept_date_end'      => $raw_filter['date_end'],
                              'ept_score'         => $raw_filter['searchscore_data'],
                              'ept_type'          => $raw_filter['epttype']
                          ]) }}" id="generate" class="btn btn-primary" target="_blank">Export to PDF</a>
                        <?php endif ?>
                        <?php endif ?>
                    </div>
                </div>
            </div> <!-- /Portlet -->
        </div> <!-- end col -->
    </div> <!-- end row -->

    <!-- TEST PAGE FOR PERCENTAGE -->
    <?php if (isset($raw_filter)) : ?>
      <?php if ($raw_filter['date_start'] != "" && $raw_filter['date_end'] != "" && $raw_filter["searchscore_data"] != ""): ?>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div class="tile-stats white-bg">
                <div class="status">
                    <h3 class="m-t-0"><span class="counter">{{ $latest_pass_percentage }}</span>% <i class="fa fa-child"></i></h3>
                    <?php if (isset($ket)): ?>
                        <?php if ($ket["searchscore"] != ""): ?>
                          <p>EPT Participants S1/D3 With Score Range {{ $ket["searchscore"] }}</p>
                        <?php endif ?>
                    <?php endif ?>
                </div>
                <div class="chart-inline">
                    <span class="dailyEptPart"></span>
                </div>
            </div>
        </div>

        <!-- <div class="col-lg-3 col-sm-6">
            <div class="tile-stats white-bg">
                <div class="status">
                    <h3 class="m-t-0 counter">{{ $sum_latest_part }}</h3>
                    <p>Daily Registered S1/D3 on the latest EPT</p>
                </div>
                <span class="monthlyRegistered"></span>
            </div>
        </div> -->

        <div class="col-lg-6 col-sm-12">
            <div class="tile-stats white-bg">
                <div class="status">
                    <h3 class="m-t-0"><span class="counter">{{ $latest_pass_percentage_s2 }}</span>% <i class="fa fa-child"></i></h3>
                    <?php if (isset($ket)): ?>
                        <?php if ($ket["searchscore"] != ""): ?>
                          <p>EPT Participants Post Graduate/Public With Score Range {{ $ket["searchscore"] }}</p>
                        <?php endif ?>
                    <?php endif ?>
                </div>
                <div class="chart-inline">
                    <span class="dailyEptParts2"></span>
                </div>
            </div>
        </div>

        <!-- <div class="col-lg-3 col-sm-6">
            <div class="tile-stats white-bg">
                <div class="status">
                    <h3 class="m-t-0 counter">{{ $sum_latest_part_s2 }}</h3>
                    <p>Daily Registered S2/Public on the latest EPT</p>
                </div>
                <span class="monthlyRegistereds2"></span>
            </div>
        </div> -->
    </div>
    <?php endif ?>
    <?php endif ?>
    <!-- END TEST PAGE FOR PERCENTAGE -->

    <!-- NEW ROW FOR CHART -->
      <div class="row">
          <div class="col-lg-12">
              <div class="portlet">
            <div class="portlet-heading">
              <h3 class="portlet-title text-dark text-uppercase">EPT CHART FILTER</h3>
            </div>
            <div class="portlet-body">
              <strong>Operating Guide</strong><br><br>
              <p>
                1. Fill the date and score range in the available filter <br>
                <b>2. Result will only show the last seven test date</b><br>
                3. If the charts does not appear,
                there is no score value on that date, or the selected date is invalid <br>
                4. Download <b>PDF Chart Report</b> to see more details about it when filter has been activated <br>

              <br><br>
              <p><strong>Choose Score Range and Date</strong></p>
              <div class="row text-center m-t-50 m-b-10">
                <form action="{{ route('adminept.eptfaculty.filter') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="btn-group m-b-10">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12" style="margin-top: 10px;">
                                                <div class="row" style="margin-left: 1px;">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                  <input type="text" autocomplete="off" required="" name="ept_date_start" class="form-control" placeholder="Start Date" id="datepicker">
                                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                  <input type="text" autocomplete="off" required="" name="ept_date_end" class="form-control" placeholder="End Date" id="datepicker2">
                                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <select class="form-control" name="ept_score" id="ept_score" required="">
                                                            <option selected value="" disabled>- Choose Score Range -</option>
                                                            <option value="6">- Choose All Score -</option>
                                                            <option value="1">677 >= x > 600</option>
                                                            <option value="2">600 >= x > 500</option>
                                                            <option value="3">500 >= x > 450</option>
                                                            <option value="4">450 >= x > 400</option>
                                                            <option value="5"><= 400</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <div class="btn-group m-b-10">
                                                            <div class="btn-group dropdown">
                                                                <button type="submit" class="btn btn-primary" name="type_file">Find EPT Chart</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
              </div>

            </div>

            </div>
          </div>
        </div>

    <!-- END NEW ROW FOR CHART -->


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

  var epttype = "{{ $raw_filter['epttype'] }}";

  if (epttype == "" || epttype == 1) {
    Morris.Bar({
        element: 's1_ept',
        data: {!! $ept_s1 !!},
        xkey: 'y',
        ykeys: ['a', 'b', 'c'],
        labels: ['Highest Score', 'Average Score', 'Lowest Score'],
        gridLineColor: '#eef0f2',
        barSizeRatio: 0.3,
        numLines: 6,
        barGap: 4,
        resize: true,
        hideHover: 'auto',
        barColors: ['#34c73b', '#3960d1', '#ff7979']
    });
  }

  if (epttype == "" || epttype == 2) {
    Morris.Bar({
        element: 's2_ept',
        data: {!! $ept_s2 !!},
        xkey: 'y',
        ykeys: ['a', 'b', 'c'],
        labels: ['Highest Score', 'Average Score', 'Lowest Score'],
        gridLineColor: '#eef0f2',
        barSizeRatio: 0.3,
        numLines: 6,
        barGap: 4,
        resize: true,
        hideHover: 'auto',
        barColors: ['#34c73b', '#3960d1', '#ff7979']
    });
  }

</script>
@endsection
@section('footer')
  @include('isept/footerisept')
@stop
