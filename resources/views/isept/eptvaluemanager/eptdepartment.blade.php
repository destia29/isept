@extends('templateiseptunila')

@section('title')
  ISEPT Unila | EPT Chart
@endsection
@section('navbarisept')
  @include('isept/eptvaluemanager/navbareptvaluemanager')
@endsection
@section('mainisept')

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

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">EPT Chart Report</h3>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                  <!--INI DIBUAT UNTUK PERULANGAN JAVASCRIPT MORRIS BAR -->
                  <input type="hidden" id="jumlah_batch" value="{{ $jumlah_batch }}">
                  <!-- END -->
                    <h3 class="portlet-title text-dark text-uppercase">
                        EPT Participant Report - Department Level
                    </h3>
                    <?php if (isset($ket)): ?>
                        <br>
                        <h3 class="portlet-title text-dark text-uppercase">
                          Faculty {{ $ket["faculty"] }}
                          <?php if ($ket["epttype"] != ""): ?>
                            - {{ $ket["epttype"] }}
                          <?php endif ?>
                          <?php if ($ket["date"] != ""): ?>
                            <br> Date {{ $ket["date"] }}
                          <?php endif ?>
                          <?php if ($ket["searchscore"] != ""): ?>
                            <br> Score Range {{ $ket["searchscore"] }}
                          <?php endif ?>
                        </h3>
                    <?php endif ?>
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
                        <!-- ICHSAN : ELEMENT UNTUK MENAMPILKAN MORRIS BAR SECARA DINAMIS  -->
                        <?php foreach ($batch as $key => $value): ?>
                            <div id="morris-bar-{{ $key }}" style="height: 280px;"></div>
                        <?php endforeach ?>
                        <!-- END -->

                        <!-- <?php if (isset($raw_filter)) : ?>
                            <br>
                            <a href="{{ route('eptvaluemanager.eptdepartment.pdf', [
                                'ept_faculty'       => $raw_filter['faculty'],
                                'ept_type'          => $raw_filter['epttype'],
                                'ept_date_start'    => $raw_filter['date_start'],
                                'ept_date_end'      => $raw_filter['date_end'],
                                'ept_score'         => $raw_filter['searchscore_data']
                            ]) }}" id="generate" class="btn btn-primary" target="_blank">Generate Chart PDF</a>
                      <?php endif ?> -->
                      </div>
                      </div>
                    </div> <!-- /Portlet -->
                </div> <!-- end col -->
    </div> <!-- end row -->

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
                1. Choose the available faculty <br>
                2. Fill the date and score range in the available filter <br>
                <b>3. Result will only show the last seven test date</b><br>
                4. If the charts does not appear,
                there is no score value on that date, or the selected date is invalid <br>

              <br><br>
              <p><strong>Choose Faculty, Score Range, and Date</strong></p>
              <div class="row text-center m-t-50 m-b-10">
                <form action="{{ route('eptvaluemanager.eptdepartment.selectfaculty') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="btn-group m-b-10">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="row" style="margin-left: 1px;">
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="ept_faculty" id="ept_faculty" required="">
                                                            <option selected value="" disabled>- Choose All Faculty -</option>
                                                            @foreach($select_faculty as $x)
                                                                <option value="{{ $x->id }}">{{ $x->faculty_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="ept_type" id="ept_type" required="">
                                                            <option selected value="">- Choose EPT Type -</option>
                                                            <option value="1">S1 / D3</option>
                                                            <option value="2">Post Graduate/Public</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12" style="margin-top: 10px;">
                                                <div class="row" style="margin-left: 1px;">
                                                    <div class="col-sm-6">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                  <input type="text" name="ept_date_start" class="form-control" placeholder="Start Date" id="datepicker" autocomplete="off" required="">
                                                                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                  <input type="text" name="ept_date_end" class="form-control" placeholder="End Date" id="datepicker2" autocomplete="off" required="">
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
  // ICHSAN : DEFINE CHART MORRIS BAR
  var jumlah_batch = $("#jumlah_batch").val();
  <?php for ($i = 0; $i < $jumlah_batch; $i++) { $data_bar = json_encode($batch[$i], JSON_NUMERIC_CHECK); ?>
    var i = "{{ $i }}";
    var data = {!! $data_bar !!};
    Morris.Bar({
        element: 'morris-bar-'+i,
        data: data,
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
  <?php } ?>
  // END

  $(document).ready(function(){
  });
</script>

@endsection
@section('footer')
  @include('isept/footerisept')
@stop
