@extends('templateiseptunila')

@section('title')
  ISEPT Unila | Register EPT
@endsection
@section('navbarisept')
  @include('isept/eptparticipant/navbareptparticipant')
@endsection

@section('style')

@endsection

@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Register EPT</h3>
    </div>
      @if($registerept != NULL && $registerept->status == "Unverified")
      <div class="alert alert-default alert-dismissable" style="background-color:#f39c12; color:white">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Thank you for registering for the English Proficiency Test.<br> You need to complete your payment by visiting the Languace Center of Unila.<br>
          If you have any questions please visit Language Center of Unila or <a href="{{ url('contactus') }}" class="alert-link" target="_blank">Contact Us</a>.<br>
      </div>
      @elseif($registerept != NULL && $registerept->status == "Verified")
      <div class="alert alert-default alert-dismissable" style="background-color:#3498db; color:white">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          Thank you for your payment. Your transaction has been completed.<br>
          If you have any questions please visit Language Center of Unila or <a href="{{ url('contactus') }}" class="alert-link" target="_blank">Contact Us</a>.<br>
          Thank you and we hope you will get very good marks!
      </div>
      @else
      @endif
      @if(Auth::user()->eptparticipant->userstatus == "Nonactive")
      <div class="alert alert-danger alert-dismissable">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          @if($failept1 >= 3)
            You've been placed in a Nonactive user queue, since you got EPT score under 450 points for 3 times. You need to improve your English skill at LC Unila.<br>
          @else
            @if($failept2 >= 3)
              You've been placed in a Nonactive user queue, since you got EPT score under 500 points for 3 times. You need to improve your English skill at LC Unila.<br>
            @else
              You've been placed in a Nonactive user queue, since you've abandoned your English Proficiency Test more than 2 times.<br>
            @endif
          @endif
          Once you've placed to a Nonactive user, u can't register new English Proficiency Test.<br>
          To Re-active your account you need to visit Language Center of Unila or <a href="{{ url('contactus') }}" class="alert-link" target="_blank">Contact Us</a>.
      </div>
      @else
      @endif

    @if(Auth::user()->eptparticipant->userstatus != "Nonactive")
    <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="panel-heading"><h3 class="panel-title">Register EPT Form</h3></div>
                <div class="col-sm-6">
                    <form method="POST" action="{{ route('eptparticipant.register.ept') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                    <div class="form-horizontal p-20" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label">NPM/NIK</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" disabled="" value="{{ Auth::user()->eptparticipant->idnumber_eptparticipant }}" name="npm_nik">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email Address <star>*</star></label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" value="{{ Auth::user()->email }}" name="email">
                                  @if ($errors->has('email'))
                                  <span class="help-block text-danger">
                                      {{ $errors->first('email') }}
                                  </span>
                                  @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Full Name <star>*</star></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" placeholder="Nama" name="name">
                                    @if ($errors->has('name'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('name') }}
                                    </span>
                                    @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Participant Type <star>*</star></label>
                            <div class="col-sm-6">
                                <input type="hidden" id="participant_type_value" name="participant_type">
                                <select class="form-control" id="participant_type" disabled="">
                                    <option selected disabled>- Choose Participant Type -</option>
                                    @if(Auth::user()->eptparticipant->id_major != NULL)
                                      <option value="1">Public</option>
                                      <option selected value="2">Unila Student</option>
                                    @else
                                      <option selected value="1">Public</option>
                                      <option value="2">Unila Student</option>
                                    @endif
                                </select>
                                @if ($errors->has('participant_type'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('participant_type') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group faculty">
                            <label class="col-md-3 control-label">Faculty <star>*</star></label>
                            <div class="col-md-6">
                                <input type="hidden" id="faculty_value" name="id_faculty">
                                <select class="form-control" id="faculty" disabled="">
                                    @if(Auth::user()->eptparticipant->id_major != NULL)
                                    <option disabled>- Choose Faculty -</option>
                                      @foreach($faculty as $data)
                                      @if(Auth::user()->eptparticipant->major->id_faculty == $data->id)
                                        <option selected value="{{ $data->id }}">{{ $data->faculty_name }}</option>
                                      @else
                                        <option value="{{ $data->id }}">{{ $data->faculty_name }}</option>
                                      @endif
                                      @endforeach
                                    @else
                                    <option selected disabled>- Choose Faculty -</option>
                                    @foreach($faculty as $data)
                                        <option value="{{ $data->id }}">{{ $data->faculty_name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div> <!-- form-group -->
                        <div class="form-group major">
                            <label class="col-md-3 control-label">Major <star>*</star></label>
                            <div class="col-md-6">
                                <input type="hidden" id="major_value" name="id_major">
                                <select class="form-control" id="major" disabled="">
                                    @if(Auth::user()->eptparticipant->id_major != NULL)
                                    <option disabled>- Choose Major -</option>
                                      @foreach($list_major as $data)
                                      @if(Auth::user()->eptparticipant->id_major == $data->id)
                                        <option selected value="{{ $data->id }}">{{ $data->major_name }}</option>
                                      @else
                                        <option value="{{ $data->id }}">{{ $data->major_name }}</option>
                                      @endif
                                      @endforeach
                                    @else
                                    <option selected disabled>- Choose Major -</option>
                                    @endif
                                </select>
                            </div>
                        </div> <!-- form-group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Place of Birth <star>*</star></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ Auth::user()->eptparticipant->place_of_birth }}" name="place_of_birth">
                                @if ($errors->has('place_of_birth'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('place_of_birth') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date of birth <star>*</star></label>
                            <div class="col-md-6">
                              <div class="input-group">
                                <input type="text" value="{{ date('m/d/Y', strtotime(Auth::user()->eptparticipant->date_of_birth)) }}" name="date_of_birth" class="form-control" id="datepicker">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div>
                              @if ($errors->has('date_of_birth'))
                              <span class="help-block text-danger">
                                  {{ $errors->first('date_of_birth') }}
                              </span>
                              @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Gender <star>*</star></label>
                            <div class="col-md-6">
                                <div class="radio-inline">
                                    <label class="cr-styled" for="example-radio4">
                                      @if(Auth::user()->eptparticipant->gender == "Male")
                                        <input type="radio" id="example-radio4" name="gender" value="Male" checked><i class="fa"></i>Male
                                      @else
                                        <input type="radio" id="example-radio4" name="gender" value="Male"><i class="fa"></i>Male
                                      @endif
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label class="cr-styled" for="example-radio5">
                                      @if(Auth::user()->eptparticipant->gender == "Male")
                                        <input type="radio" id="example-radio5" name="gender" value="Female"><i class="fa"></i>Female
                                      @else
                                        <input type="radio" id="example-radio5" name="gender" value="Female" checked><i class="fa"></i>Female
                                      @endif
                                    </label>
                                </div>
                                @if ($errors->has('gender'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('gender') }}
                                </span>
                                @endif
                            </div>
                        </div> <!-- form-group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Phone Number <star>*</star></label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ Auth::user()->eptparticipant->handphone_number }}" name="handphone_number">
                                @if ($errors->has('handphone_number'))
                                <span class="help-block text-danger">
                                    {{ $errors->first('handphone_number') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="example-email">Address <star>*</star></label>
                            <div class="col-md-8">
                              <textarea class="form-control" rows="5" name="address" value="{{ Auth::user()->eptparticipant->address }}">{{ Auth::user()->eptparticipant->address }}</textarea>
                              @if ($errors->has('address'))
                              <span class="help-block text-danger">
                                  {{ $errors->first('address') }}
                              </span>
                              @endif
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-horizontal p-20" role="form">
                          <div class="form-group">
                              <label class="col-md-3 control-label">Profile Picture <star>*</star><br>(*max.200kb)</label>
                                <div class="col-md-6">
                                    <input type="hidden" name="profile_picture_name" value="{{ $participant->profile_picture }}">

                                    <img src="{{ route('eptparticipant.profile_picture', $participant->profile_picture) }}" class="media-object thumb-xlg" height="150px" width="128px">

                                    <input type="file" class="btn btn-default" name="profile_picture">
                                    @if ($errors->has('profile_picture'))
                                    <span class="help-block text-danger">
                                        {{ $errors->first('profile_picture') }}
                                    </span>
                                    @endif
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">EPT Type <star>*</star></label>
                              <div class="col-sm-6">
                                  <input type="hidden" name="ept_type" id="ept_type_value">
                                  <select class="form-control" id="ept_type" disabled="">
                                      <option selected disabled>- Choose Ept Type -</option>
                                      @foreach($type as $data)
                                          <option value="{{ $data->id }}">{{ $data->type }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Test Date <star>*</star></label>
                              <div class="col-sm-6">
                                  <select class="form-control" name="ept_date" id="ept_date">
                                      <option selected disabled>- Choose Ept Date -</option>
                                  </select>
                                  @if ($errors->has('ept_date'))
                                  <span class="help-block text-danger">
                                      {{ $errors->first('ept_date') }}
                                  </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Test Time <star>*</star></label>
                              <div class="col-sm-6">
                                  <select class="form-control" name="id_ept" id="ept_time">
                                  </select>
                                  @if ($errors->has('id_ept'))
                                  <span class="help-block text-danger">
                                      The Ept Time field is required.
                                  </span>
                                  @endif
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-3 control-label">Cost</label>
                              <div class="col-md-6">
                                <input type="text" class="form-control" disabled  name="cost" id="cost">
                              </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9 control-label">
                                <input type="checkbox" required>
                                <i class="fa"></i>
                                I agree to the CL Unila <a href="{{ url('isept/eptparticipant/supportcenter') }}" target="_blank">Terms of Service</a> and <a href="{{ url('isept/eptparticipant/supportcenter') }}" target="_blank">Privacy Policy <star>*</star></a>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-1 control-label"></label>
                            <div class="col-sm-5">
                              @if(Auth::user()->eptparticipant->userstatus == "Nonactive")
                                <a class="btn btn-danger m-t-20" href="#"></i> Nonactive User</a>
                              @else
                                <button type="submit" class="btn btn-purple pull-left">Register</button>
                              @endif
                            </div>
                          </div>
                      </div>
                      </form>
                    </div>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div> <!-- End row -->
    @else
    <div class="row">
        <div class="col-md-12">
          <img class="img-responsive" style="margin: 0 auto;" src="{{ asset('images/basic/featuredisabled.png') }}" width="250px">
        </div>
    </div> <!-- End row -->
    @endif
</div>


@stop
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    check_epttype();
    var id_epttype = null;
    @if(Auth::user()->eptparticipant->id_major != NULL)
      $(".major").show();
      $(".faculty").show();
    @else
      $(".major").hide();
      $(".faculty").hide();
    @endif

    var val = $("#ept_type").val();
    $('#ept_type_value').val(val);
    id_epttype =  $("#ept_type").val();
    // e.preventDefault();

    $.ajax({
      type: "POST",
      url: "{!! route('search.ept_by_type') !!}", // path to function
      dataType: 'JSON',
      data: {
          "_token": "{{ csrf_token() }}",
          "val"  : val,
      },
      success: function(data){
          try{
              var kosong ='<option selected disabled>- Choose Ept Time -</option>';

              var locationString = '<option selected disabled>- Choose Ept Date -</option>';
              $.each(data.type, function (key, value) {
                    locationString += '<option value="' + value.ept_date + '">' + moment(value.ept_date).format("DD MMMM, YYYY") + '</option>';
                });

              $('#ept_time').html(kosong);
              $('#ept_date').html(locationString);
              $('#cost').val(data.cost);
          }
          catch(e) {
              alert('Exception while request..');
          }
      },
    });

    $('#participant_type').change(function() {
      var value=$(this).val();
      if (value == 1) {
        $(".major").hide();
        $(".faculty").hide();
      } else if(value == 2){
        $(".major").show();
        $(".faculty").show();
      }

  	});

    $("#major").change(function(){
      check_epttype();
    });

    $(document).on('change', '#faculty',function(e){
      var val = $(this).val();
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "{!! route('search.major') !!}", // path to function
        dataType: 'JSON',
        data: {
            "_token": "{{ csrf_token() }}",
            "val"  : val,
        },
        success: function(data){
          try {
            var locationString = '';
            $.each(data, function (key, value) {
              locationString += '<option value="' + value.id + '">' + value.major_name + '</option>';
            });
            $('#major').html(locationString);
          } catch(e) {
            alert('Exception while request..');
          }
        },
      });
    });

    $(document).on('change', '#ept_type',function(e) {
      var val = $(this).val();
      $('#ept_type_value').val(val);
      id_epttype =  $(this).val();
      // e.preventDefault();

      $.ajax({
        type: "POST",
        url: "{!! route('search.ept_by_type') !!}", // path to function
        dataType: 'JSON',
        data: {
            "_token": "{{ csrf_token() }}",
            "val"  : val,
        },
        success: function(data){
            try{
                var kosong ='<option selected disabled>- Choose Ept Time -</option>';

                var locationString = '<option selected disabled>- Choose Ept Date -</option>';
                $.each(data.type, function (key, value) {
                      locationString += '<option value="' + value.ept_date + '">' + moment(value.ept_date).format("DD MMMM, YYYY") + '</option>';
                  });

                $('#ept_time').html(kosong);
                $('#ept_date').html(locationString);
                $('#cost').val(data.cost);
            }
            catch(e) {
                alert('Exception while request..');
            }
        },
      });
    });

    $(document).on('change', '#ept_date',function(e){
      var val = $(this).val();
      e.preventDefault();

      $.ajax({
        type: "POST",
        url: "{!! route('search.ept_by_date') !!}", // path to function
        dataType: 'JSON',
        data: {
            "_token": "{{ csrf_token() }}",
            "val"  : val,
            "id_epttype" : id_epttype
        },
        success: function(data){
            try{
                var locationString = '';
                $.each(data, function (key, value) {
                      locationString += '<option value="' + value.id + '">' + value.ept_time.slice(0, - 3) + '</option>';
                  });
                $('#ept_time').html(locationString);

            }
            catch(e) {
                alert('Exception while request..');
            }
        },
      });
    });
  });

  function check_epttype() {
    var user_type = $("#participant_type option:selected").val();
    var major = $("#major option:selected").val();
    var faculty = $("#faculty option:selected").val();

    $("#major_value").val(major_value)
    $("#participant_type_value").val(user_type);
    $("#faculty_value").val(faculty);
    if (user_type == 1) {
      $("#ept_type").val(2);
    } else {
      var major = $("#major option:selected").text();
      if(major.indexOf("D3") != -1 || major.indexOf("S1") != -1){
        $("#ept_type").val(1);
      } else if (major.indexOf("S2") != -1 || major.indexOf("S3") != -1) {
        $("#ept_type").val(2);
      }

    }
    $("#ept_type").trigger("change");
  }
</script>
@endsection
@section('footer')
  @include('isept/footerisept')
@stop
