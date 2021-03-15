@extends('templateiseptunila')

@section('title')
  ISEPTUnila | Home
@endsection
@section('navbarisept')
  @include('isept/eptparticipant/navbareptparticipant')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Welcome !</h3>
    </div>

    <!-- WEATHER -->
    <div class="row">
      @if(Auth::user()->eptparticipant->userstatus == "Nonactive")
          <div class="col-lg-6">
            <div id="Velonic-slider" class="owl-carousel text-center" style="color:white">
                <div class="item">
                    <div class="widget-panel widget-style-1 bg-info" style="background-color:#E74C3C">
                        <i class="fa fa-ban"></i>
                    <h4 style="color:white;">Oops! You're A Nonactive User</h4>
                    @if($failept1 >= 3)
                      <p>You've been placed in a Nonactive user queue, since you got EPT score under 450 points for 3 times. You need to improve your English skill at LC Unila.</p>
                    @else
                      @if($failept2 >= 3)
                        <p>You've been placed in a Nonactive user queue, since you got EPT score under 500 points for 3 times. You need to improve your English skill at LC Unila.</p>
                      @else
                        <p>You've been placed in a Nonactive user queue, since you've abandoned your English Proficiency Test more than 2 times.</p>
                      @endif
                    @endif
                    <a href="{{ url('isept/eptparticipant/supportcenter') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;">Learn More</a>
                  </div>
                </div><!-- /.item -->

                <div class="item">
                    <div class="widget-panel widget-style-1 bg-info" style="background-color:#E74C3C">
                        <i class="fa fa-info"></i>
                    <h4 style="color:white;">Oops! You're A Nonactive User</h4>
                    <p>Once you've placed to a Nonactive user, u can't register new English Proficiency Test. To Re-active your account you need to visit Language Center of Unila or <a href="{{ url('contactus') }}" class="alert-link" target="_blank">Contact Us</a>.</p>
                    <a href="{{ url('contactus') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;" target="_blank">Contact Us</a>
                  </div>
                </div><!-- /.item -->
            </div><!-- /#tiles-slide-1 -->
          </div>
      @else
          @if($eptest != NULL && $eptest->status == "Unverified")
            <div class="col-lg-6">
              <div id="Velonic-slider" class="owl-carousel text-center" style="color:white">
                  <div class="item">
                      <div class="widget-panel widget-style-1 bg-info" style="background-color:#F4B350">
                          <i class="fa fa-credit-card"></i>
                      <h4 style="color:white;">Hey! Welcome to ISEPT</h4>
                      <p>Thank you for registering for the English Proficiency Test. You need to complete your payment by visiting the Language Center of Unila.</p>
                      <a href="{{ url('isept/eptparticipant/supportcenter') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;">Learn More</a>
                    </div>
                  </div><!-- /.item -->

                  <div class="item">
                      <div class="widget-panel widget-style-1 bg-info" style="background-color:#F4B350">
                          <i class="fa fa-info"></i>
                      <h4 style="color:white;">e-PIC Information</h4>
                      <p>Once your payment've been verified, you can view & download your e-Participant Identification Card (e-PIC) at the Profile Menu.</p>
                      <a href="{{ url('isept/eptparticipant/supportcenter') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;">Learn More</a>
                    </div>
                  </div><!-- /.item -->

                  <div class="item">
                      <div class="widget-panel widget-style-1 bg-info" style="background-color:#F4B350">
                          <i class="fa fa-info"></i>
                      <h4 style="color:white;">EPT Registration</h4>
                      <p>Please complete your payment before {{ date('l, M j Y G:i ', strtotime($gettimereg)) }}WIB.<br>
                        If you have any questions please visit Language Center of Unila or <a href="{{ url('contactus') }}" class="alert-link" style="color:#D35400;" target="_blank">Contact Us</a></p>
                      <a href="{{ url('contactus') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;" target="_blank">Contact Us</a>
                    </div>
                  </div><!-- /.item -->

              </div><!-- /#tiles-slide-1 -->
            </div>
          @elseif($eptest != NULL && $eptest->status == "Verified")
            <div class="col-lg-6">
              <div id="Velonic-slider" class="owl-carousel text-center" style="color:white">
                  <div class="item">
                      <div class="widget-panel widget-style-1 bg-info" style="background-color:#6C7A89">
                          <i class="fa fa-ticket"></i>
                      <h4 style="color:white;">Hey! Welcome to ISEPT</h4>
                      <p>Thank you for your payment. Your transaction has been completed. Now you can view or download your e-Participant Identification Card (e-PIC).</p>
                      <a href="{{ url('isept/eptparticipant/myprofile') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;" target="_blank">View My e-PIC</a>
                    </div>
                  </div><!-- /.item -->

                  <div class="item">
                      <div class="widget-panel widget-style-1 bg-info" style="background-color:#6C7A89">
                          <i class="fa fa-info"></i>
                      <h4 style="color:white;">Your Test Information</h4>
                      <p>Your English Proficiency Test starts on {{ date('l, M j Y', strtotime($getdatetest)) }} at {{ date('G:i ', strtotime($gettimetest)) }}WIB and will be held at {{ $eptest->room_name }}.</p>
                      <a href="{{ url('contactus') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;" target="_blank">View More</a>
                    </div>
                  </div><!-- /.item -->

                  <div class="item">
                      <div class="widget-panel widget-style-1 bg-info" style="background-color:#6C7A89">
                          <i class="fa fa-print"></i>
                      <h4 style="color:white;">No need to print!</h4>
                      <p>Show your e-PIC in your Profile Menu and your ID Card such as KTM, KTP, SIM, or Passport when you entering the EPT Room.</p>
                      <a href="{{ url('isept/eptparticipant/myprofile') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;" target="_blank">View My e-PIC</a>
                    </div>
                  </div><!-- /.item -->

                  <div class="item">
                      <div class="widget-panel widget-style-1 bg-info" style="background-color:#6C7A89">
                          <i class="fa fa-question"></i>
                      <h4 style="color:white;">Need Help?</h4>
                      <p>If you have any questions please visit Language Center of Unila or <a href="{{ url('contactus') }}" class="alert-link" style="color:#86E2D5;" target="_blank">Contact Us</a>.
                      Thank you and we hope you will get very good marks!</p>
                      <a href="{{ url('contactus') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;" target="_blank">Contact Us</a>
                    </div>
                  </div><!-- /.item -->

              </div><!-- /#tiles-slide-1 -->
            </div>
          @else
            <div class="col-lg-6">
              <div id="Velonic-slider" class="owl-carousel text-center" style="color:white">
                  <div class="item">
                      <div class="widget-panel widget-style-1 bg-info" style="background-color:#6C7A89">
                          <i class="fa fa-info"></i>
                      <h4 style="color:white;">Hey! Welcome to ISEPT</h4>
                      <p>You haven't registered any EPT yet. Let's get started by updating your profile before Register an EPT.</p>
                      <a href="{{ url('isept/eptparticipant/myprofile') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;" target="_blank">Edit My Profile</a>
                    </div>
                  </div><!-- /.item -->

                  <div class="item">
                      <div class="widget-panel widget-style-1 bg-info" style="background-color:#6C7A89">
                          <i class="fa fa-question"></i>
                      <h4 style="color:white;">Need Help?</h4>
                      <p>If you have any questions please visit Language Center of Unila or <a href="{{ url('contactus') }}" class="alert-link" style="color:#86E2D5;" target="_blank">Contact Us</a>.</p>
                      <a href="{{ url('contactus') }}" class="btn btn-sm m-t-5" style="background-color:#03C9A9; color:white;" target="_blank">Contact Us</a>
                    </div>
                  </div><!-- /.item -->

              </div><!-- /#tiles-slide-1 -->
            </div>
          @endif
        @endif

        <div class="col-lg-6">

            <!-- BEGIN WEATHER WIDGET 1 -->
                <div class="panel-body">

                    <div class="row">
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
                            <div class="widget-panel widget-style-1 bg-warning" style="background-color:
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
                    </div><!-- end row -->
                </div><!-- panel-body -->
            <!-- END Weather WIDGET 1 -->

        </div><!-- End col-md-6 -->
    </div> <!-- End row -->
    <div class="row">

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
                        <div id="s1_ept" style="height: 280px;"></div>
                      @endif
                          <div class="row text-center m-t-30 m-b-30">
                              <div class="col-sm-3 col-xs-6">
                                  <h4>
                                    @if(!empty($latest_score->listening_score))
                                      {{ $latest_score->listening_score }}
                                    @else
                                      NO RECORD
                                    @endif
                                  </h4>
                                  <small class="text-muted">Latest Listening Score</small>
                              </div>
                              <div class="col-sm-3 col-xs-6">
                                  <h4>
                                    @if(!empty($latest_score->structure_score))
                                      {{ $latest_score->structure_score }}
                                    @else
                                      NO RECORD
                                    @endif
                                  </h4>
                                  <small class="text-muted">Latest Structure Score</small>
                              </div>
                              <div class="col-sm-3 col-xs-6">
                                  <h4>
                                    @if(!empty($latest_score->reading_score))
                                      {{ $latest_score->reading_score }}
                                    @else
                                      NO RECORD
                                    @endif
                                  </h4>
                                  <small class="text-muted">Latest Reading Score</small>
                              </div>
                              <div class="col-sm-3 col-xs-6">
                                  <h4>
                                    @if(!empty($latest_score->total_score))
                                      {{ $latest_score->total_score }}
                                    @else
                                      NO RECORD
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
                        <div id="s2_ept" style="height: 280px;"></div>
                      @endif
                          <div class="row text-center m-t-30 m-b-30">
                            <div class="col-sm-3 col-xs-6">
                                <h4>
                                  @if(!empty($latest_score->listening_score))
                                    {{ $latest_score->listening_score }}
                                  @else
                                    NO RECORD
                                  @endif
                                </h4>
                                <small class="text-muted">Latest Listening Score</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>
                                  @if(!empty($latest_score->structure_score))
                                    {{ $latest_score->structure_score }}
                                  @else
                                    NO RECORD
                                  @endif
                                </h4>
                                <small class="text-muted">Latest Structure Score</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>
                                  @if(!empty($latest_score->reading_score))
                                    {{ $latest_score->reading_score }}
                                  @else
                                    NO RECORD
                                  @endif
                                </h4>
                                <small class="text-muted">Latest Reading Score</small>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <h4>
                                  @if(!empty($latest_score->total_score))
                                    {{ $latest_score->total_score }}
                                  @else
                                    NO RECORD
                                  @endif

                                </h4>
                                <small class="text-muted">Latest Total Score</small>
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
                        Your Tests
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
                                        <th class="text-center">Attempt</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Test Card</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(empty($mytest))
                                  <tr>
                                    <td colspan="8"><p class="text-center"><img src="{{ asset('images/basic/norecordsfound.png') }}" width="150px"></p></td>
                                  </tr>
                                  @else
                                  <?php $i=1; ?>
                                  @foreach($mytest as $data)
                                    <tr>
                                      <td align="center">{{ $i++ }}</td>
                                      <td>{{ $data->type }}</td>
                                      <td>{{ date('d F Y', strtotime($data->ept_eptdate)) }}</td>
                                      <td>{{ $data->ept_epttime }}</td>
                                      <td>{{ date('d F Y', strtotime($data->ept_registrationdate)) }}</td>
                                      @if($data->status != "Abandoned")
                                      <td align="center">{{ $data->attempt }}</td>
                                      @else
                                      <td align="center">-</td>
                                      @endif
                                      <td align="center">
                                          @if($data->status == "Unverified")
                                              <span class="label label-pink">Unverified</span>
                                          @elseif($data->status == "Verified")
                                              <span class="label label-success">Verified</span>
                                          @elseif($data->status == "Done")
                                              <span class="label label-info">Done</span>
                                          @else
                                              <span class="label label-danger">Abandoned</span>
                                          @endif
                                      </td>
                                          @if($data->status == "Unverified")
                                          <td align="center"><a href="#" class="btn btn-primary btn-xs" disabled>View</a></td>
                                          @elseif($data->status == "Verified")
                                          <td align="center"><a href="{{ route('eptparticipant.myprofile.viewpic', $data->reg_id) }}" class="btn btn-primary btn-xs">View</a></td>
                                          @elseif($data->status == "Done")
                                          <td align="center"><a href="{{ route('eptparticipant.myprofile.viewpic', $data->reg_id) }}" class="btn btn-primary btn-xs">View</a></td>
                                          @else
                                          <td align="center"><a href="#" class="btn btn-primary btn-xs" disabled>View</a></td>
                                          @endif
                                    </tr>
                                  @endforeach
                                  @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div> <!-- end row -->


    <div class="row">

        <div class="col-lg-12">

            <div class="portlet"><!-- /primary heading -->
                <div class="portlet-heading">
                    <h3 class="portlet-title text-dark text-uppercase">
                        Available Tests
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
                                        <th class="text-center">Registered</th>
                                        <th class="text-center">Status</th>
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
                                              </td>
                                            <td align="center">{{ $data->registerept_participant->count() }}</td>
                                            <td align="center">
                                                @if($total <= $data->registerept_participant->count())
                                                    <span class="label label-danger">Full</span>
                                                @else
                                                    <span class="label label-success">Available</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <?php $total=0; ?>
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
      element: 's2_ept',
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
</script>
@endsection

@section('footer')
  @include('isept/footerisept')
@stop
