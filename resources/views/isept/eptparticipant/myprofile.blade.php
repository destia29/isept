@extends('templateiseptunila')

@section('title')
  ISEPT Unila | My Profile
@endsection
@section('navbarisept')
  @include('isept/eptparticipant/navbareptparticipant')
@endsection
@section('mainisept')


<div class="wraper container-fluid">
    @if (count($errors) > 0)
    <div class="row">
     <div class="alert alert-danger">
      <ul>
       @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
       @endforeach
      </ul>
     </div>
    </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="bg-picture" style="background-image:url('{{ asset ('img/bg_6.jpg') }}')">
              <span class="bg-picture-overlay">
                @if(Auth::user()->eptparticipant->userstatus == "Nonactive")
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    You've been placed in a Nonactive user queue, since you've abandoned your English Proficiency Test more than 2 times.<br>
                    Once you've placed to a Nonactive user, you can't register a new English Proficiency Test.<br>
                    To Re-active your account you need to visit Language Center of Unila or <a href="{{ url('contactus') }}" class="alert-link" target="_blank">Contact Us</a>.
                </div>
                @else
                @endif</span><!-- overlay -->
              <!-- meta -->
              <div class="box-layout meta bottom">
                <div class="col-sm-6 clearfix">
                  <span class="img-wrapper pull-left m-r-15"><img src="{{ route('eptparticipant.profile_picture', Auth::user()->eptparticipant->profile_picture ) }}" alt="" style="height:68px; width:54px" class="br-radius"></span>
                  <div class="media-body">
                    <h3 class="text-white mb-2 m-t-10 ellipsis">{{ Auth::user()->name }}</h3>
                    <h5 class="text-white"> Lampung</h5>
                  </div>
                </div>
                <div class="col-sm-6">

                  <div class="pull-right">
                      @if(Auth::user()->eptparticipant->userstatus == "Nonactive")
                      <a class="btn btn-danger m-t-20" href="#"></i> Nonactive User</a>
                      @else
                      <a class="btn btn-primary m-t-20" href="#"></i> Active User</a>
                      @endif
                  </div>
                </div>
              </div>
              <!--/ meta -->
            </div>
        </div>
    </div>

    <div class="row m-t-30">
        <div class="col-sm-12">
            <div class="panel panel-default p-0">
                <div class="panel-body p-0">
                    <ul class="nav nav-tabs profile-tabs">
                        <li class="active"><a data-toggle="tab" href="#aboutme">About Me</a></li>
                        <!-- <li class=""><a data-toggle="tab" href="#user-activities">Activities</a></li> -->
                        <li class=""><a data-toggle="tab" href="#edit-profile">Settings</a></li>
                        <li class=""><a data-toggle="tab" href="#projects">Tests</a></li>
                    </ul>

                    <div class="tab-content m-0">

                        <div id="aboutme" class="tab-pane active">
                        <div class="profile-desk">
                            <h1>{{ Auth::user()->name }}</h1>
                            <span class="designation">Participant (
                                @if(Auth::user()->eptparticipant->id_major != NULL)
                                    {{ Auth::user()->eptparticipant->major->faculty->faculty_name }} / {{ Auth::user()->eptparticipant->major->major_name }}
                                @else
                                Public
                                @endif)</span>
                            <p>
                                This is your account information, these informations will be used to input your registration form automatically.<br>Don’t worry about your test result. We know that you will get very good marks. Trust yourself!
                            </p>
                            <a class="btn btn-primary m-t-20" href="{{ url('isept/eptparticipant/myeptscore') }}"></i> See My Score</a>

                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="3"><h3>Account Information</h3></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>Name</b></td>
                                        <td class="ng-binding">
                                            {{ Auth::user()->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Username</b></td>
                                        <td class="ng-binding">
                                            {{ Auth::user()->username }}
                                        </td>
                                    </tr>
                                    <tr>
                                        @if(Auth::user()->eptparticipant->id_major != NULL)
                                        <td><b>NPM</b></td>
                                        @else
                                        <td><b>NIK</b></td>
                                        @endif
                                        <td class="ng-binding">
                                            {{ Auth::user()->eptparticipant->idnumber_eptparticipant }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Faculty / Major</b></td>
                                        <td class="ng-binding">
                                            @if(Auth::user()->eptparticipant->id_major != NULL)
                                                {{ Auth::user()->eptparticipant->major->faculty->faculty_name }} / {{ Auth::user()->eptparticipant->major->major_name }}
                                            @else
                                            -
                                            @endif
                                        </a></td>
                                    </tr>
                                    <tr>
                                        <td><b>Birth Place / Birth Date</b></td>
                                        <td class="ng-binding">
                                            {{ Auth::user()->eptparticipant->place_of_birth }} / {{ date('d F Y', strtotime(Auth::user()->eptparticipant->date_of_birth)) }}
                                        </a></td>
                                    </tr>
                                    <tr>
                                        <td><b>Gender</b></td>
                                        <td class="ng-binding">
                                            {{ Auth::user()->eptparticipant->gender }}
                                        </a></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td class="ng-binding">
                                            {{ Auth::user()->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone</b></td>
                                        <td class="ng-binding">{{ Auth::user()->eptparticipant->handphone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Address</b></td>
                                        <td class="ng-binding">{{ Auth::user()->eptparticipant->address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end profile-desk -->
                    </div> <!-- about-me -->


                    <!-- Activities -->
                    <!-- <div id="user-activities" class="tab-pane">
                        <div class="timeline-2">
                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">5 minutes ago</div>
                                    <p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">30 minutes ago</div>
                                    <p><a href="#" class="text-info">Lorem</a> commented your post.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">59 minutes ago</div>
                                    <p><a href="#" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">5 minutes ago</div>
                                    <p><strong><a href="#" class="text-info">John Doe</a></strong>Uploaded 2 new photos</p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">30 minutes ago</div>
                                    <p><a href="#" class="text-info">Lorem</a> commented your post.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">59 minutes ago</div>
                                    <p><a href="#" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- settings -->
                    <div id="edit-profile" class="tab-pane">
                        <div class="user-profile-content">
                            <form role="form" class="col-md-8" action="{{ route('isept.myprofile.eptparticipant.edit.post') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="id_eptparticipant" value="{{ Auth::user()->eptparticipant->id }}">
                                <div class="form-group">
                                    <label for="FullName">Name <star>*</star></label>
                                    <input type="text" name="name" value="{{ Auth::user()->name }}" id="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Email">Username <star>*</star></label>
                                    <input type="text" name="username" value="{{ Auth::user()->username }}" id="username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Username">
                                    @if(Auth::user()->eptparticipant->id_major != NULL)
                                    NPM
                                    @else
                                    NIK
                                    @endif
                                    </label>
                                    <input type="text" value="{{ Auth::user()->eptparticipant->idnumber_eptparticipant }}" id="idnumber_eptparticipant" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="Username">Participant Type <star>*</star></label>
                                    <select class="form-control" id="p_type" name="p_type">
                                        <option selected disabled>- Choose Participant Type -</option>
                                        @if(Auth::user()->eptparticipant->id_major != NULL)
                                          <option value="1">Public</option>
                                          <option selected value="2">Unila Student</option>
                                        @else
                                          <option selected value="1">Public</option>
                                          <option value="2">Unila Student</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="faculty">
                                  <label for="Faculty">Faculty / Major <star>*</star></label>
                                  <div class="form-inline">
                                      <div class="form-group">
                                          <select class="form-control" id="faculty" name="id_faculty">

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
                                      <label for="Major">&nbsp; /</label>
                                      <div class="form-group m-l-10">
                                          <select class="form-control" id="major" name="id_major">
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
                                  </div>
                                  <br>
                                </div>
                                <label for="Birthplace">Birth Place / Birth Date <star>*</star></label>
                                <div class="form-inline">
                                    <div class="form-group">
                                        <input type="text" name="place_of_birth" value="{{ Auth::user()->eptparticipant->place_of_birth }}" id="birthplace" class="form-control">
                                    </div>
                                    <label for="Birthplace">&nbsp; /</label>
                                    <div class="form-group m-l-10">
                                      <input type="text" name="date_of_birth" value="{{ date('m/d/Y', strtotime(Auth::user()->eptparticipant->date_of_birth)) }}" name="date_of_birth" class="form-control" id="datepicker">
                                      <i class="glyphicon glyphicon-calendar"></i>
                                    </div>
                                </div>
                                <br>
                                <label for="gender">Gender <star>*</star></label>
                                <div class="form-group">
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
                                </div> <!-- form-group -->
                                <div class="form-group">
                                    <label for="Email">Email <star>*</star></label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" id="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Phone">Phone Number <star>*</star></label>
                                    <input type="text" name="handphone_number" value="{{ Auth::user()->eptparticipant->handphone_number }}" id="handphone_number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="AboutMe">Address <star>*</star></label>
                                    <textarea style="height: 100px;" name="address" id="AboutMe" class="form-control">{{ Auth::user()->eptparticipant->address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="Photo Profile">Photo Profile (max.200kb) <star>*</star></label>
                                        <input type="hidden" name="profile_picture_name" value="{{ Auth::user()->eptparticipant->profile_picture }}">
                                        <img src="{{ route('eptparticipant.profile_picture', Auth::user()->eptparticipant->profile_picture) }}" class="media-object thumb-xlg" height="127px" width="100px">

                                        <input type="file" class="btn btn-default" name="profile_picture">
                                </div>
                                <button class="btn btn-primary" type="submit">Update</button>
                                <br><br>
                            </form>
                        </div>
                    </div>


                    <!-- profile -->
                    <div id="projects" class="tab-pane">
                        <div class="row m-t-10">
                            <div class="col-md-12">
                                <div class="portlet"><!-- /primary heading -->
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
                                                      <?php $i=1; ?>
                                                      @foreach($myprofile as $data)
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
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /Portlet -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



</div>


@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
      @if(Auth::user()->eptparticipant->id_major != NULL)
      $(".major").show();
      $(".faculty").show();
      @else
      $(".major").hide();
      $(".faculty").hide();
      @endif

    $('#p_type').change(function() {
		var value=$(this).val();
		if (value == 1) {
			$(".major").hide();
            $(".faculty").hide();
		}
		else if(value == 2){
            $(".major").show();
            $(".faculty").show();
		}
	});

    $(document).on('change', '#faculty',function(e)
        {
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
        try{
        var locationString = '';
        $.each(data, function (key, value) {
                  locationString += '<option value="' + value.id + '">' + value.major_name + '</option>';
              });
        $('#major').html(locationString);
        }catch(e) {
        alert('Exception while request..');
        }
        },
        });
      });
    });
</script>
@endsection
@section('footer')
  @include('isept/footerisept')
@stop
