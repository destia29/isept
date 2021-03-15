@extends('templateiseptunila')

@section('title')
  ISEPT Unila | Edit EPT Participant's Certificate
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">EPT Participant's Certificate</h3>
    </div>
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
          <div class="panel panel-default">
            <div class="panel-body">
              <div class="panel-heading"><h3 class="panel-title">Edit EPT Participant's Certificate Form</h3></div>
                <div class="col-sm-6">
                    <form method="POST" action="{{ route('adminept.eptcertificate.edit.post') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_reg" value="{{ $edit->id }}">
                    <input type="hidden" name="id_user" value="{{ Auth::id() }}">
                    <div class="form-horizontal p-20" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label">NPM/NIK</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" disabled="" value="{{ $edit->eptparticipant->idnumber_eptparticipant }}" name="npm_nik">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email Address</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" value="{{ $edit->eptparticipant->user->email }}" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Full Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $edit->eptparticipant->user->name }}" placeholder="Nama" name="name" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Participant Type</label>
                            <div class="col-md-6">
                                @if($edit->eptparticipant->id_major != NULL)
                                <input type="text" class="form-control" value="Unila Students" placeholder="Nama" name="name" disabled="">
                                @else
                                <input type="text" class="form-control" value="Public" placeholder="Nama" name="name" disabled="">
                                @endif
                            </div>
                        </div>
                        @if($edit->eptparticipant->id_major != NULL)
                        <div class="form-group">
                            <label class="col-md-3 control-label">Faculty</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $edit->eptparticipant->major->faculty->faculty_name }}" placeholder="Nama" name="name" disabled="">
                            </div>
                        </div> <!-- form-group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Major</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $edit->eptparticipant->major->major_name }}" placeholder="Nama" name="name" disabled="">
                            </div>
                        </div> <!-- form-group -->
                        @else
                        @endif
                        <div class="form-group">
                            <label class="col-md-3 control-label">Place of Birth</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $edit->eptparticipant->place_of_birth }}" name="place_of_birth" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Date of birth</label>
                            <div class="col-md-6">
                              <div class="input-group">
                                <input type="text" value="{{ $edit->eptparticipant->date_of_birth }}" name="date_of_birth" class="form-control" id="datepicker" disabled="">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Gender</label>
                            <div class="col-md-6">
                                <div class="radio-inline">
                                    <label class="cr-styled" for="example-radio4">
                                      @if($edit->eptparticipant->gender == "Male")
                                        <input type="radio" id="example-radio4" name="gender" value="Male" checked disabled=""><i class="fa"></i>Male
                                      @else
                                        <input type="radio" id="example-radio4" name="gender" value="Male" disabled=""><i class="fa"></i>Male
                                      @endif
                                    </label>
                                </div>
                                <div class="radio-inline">
                                    <label class="cr-styled" for="example-radio5">
                                      @if($edit->eptparticipant->gender == "Male")
                                        <input type="radio" id="example-radio5" name="gender" value="Female" disabled=""><i class="fa"></i>Female
                                      @else
                                        <input type="radio" id="example-radio5" name="gender" value="Female" checked disabled=""><i class="fa"></i>Female
                                      @endif
                                    </label>
                                </div>
                            </div>
                        </div> <!-- form-group -->
                        <div class="form-group">
                            <label class="col-md-3 control-label">Phone Number</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $edit->eptparticipant->handphone_number }}" name="handphone_number" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="example-email">Address</label>
                            <div class="col-md-6">
                              <textarea class="form-control" rows="5" name="address" value="" disabled="">{{ $edit->eptparticipant->address }}</textarea>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                      <div class="form-horizontal p-20" role="form">
                          <div class="form-group">
                              <label class="col-md-3 control-label">Profile Picture</label>
                                <div class="col-md-6">
                                    <input type="hidden" name="profile_picture_name" value="{{ $edit->eptparticipant->profile_picture }}">

                                    <img src="{{ route('adminept.eptparticipant.profile_picture', $edit->eptparticipant->profile_picture) }}" class="media-object thumb-xlg" height="150px" width="128px">
                                </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">EPT Type</label>
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" value="{{ $edit->ept->type->type }}" name="epttype" disabled="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Test Date</label>
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" value="{{ date('F d, Y', strtotime($edit->ept->ept_date)) }}" name="epttype" disabled="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Test Time</label>
                              <div class="col-sm-6">
                                  <input type="text" class="form-control" value="{{ date('H:i A', strtotime($edit->ept->ept_time)) }}" name="epttype" disabled="">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-3 control-label">Cost</label>
                              <div class="col-md-6">
                                <input type="text" class="form-control" disabled  name="cost" value="{{ $edit->ept->type->modif_cost }}">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Status <star>*</star></label>
                              <div class="col-sm-6">
                                  <select class="form-control" name="status">
                                      @if($edit->status == "Verified")
                                      <option value="Verified" selected>{{ $edit->status }}</option>
                                      <option value="Done">Done</option>
                                      @elseif($edit->status == "Done")
                                      <option value="Done" selected>{{ $edit->status }}</option>
                                      <option value="Verified">Verified</option>
                                      @endif
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                            <div class="col-sm-9 control-label">
                                <input type="checkbox" required>
                                <i class="fa"></i>
                                Be Careful whenever you change the status <star>*</star>
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label"></label>
                            <div class="col-sm-5">
                              <button type="submit" class="btn btn-purple pull-left">Change Status</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div> <!-- End row -->
</div>


@stop
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $(".major").hide();
        $(".faculty").hide();
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

        $(document).on('change', '#ept_type',function(e)
        {
            var val = $(this).val();
            e.preventDefault();

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
                          locationString += '<option value="' + value.ept_date + '">' + value.ept_date + '</option>';
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

        $(document).on('change', '#ept_date',function(e)
        {
            var val = $(this).val();
            e.preventDefault();

            $.ajax({
            type: "POST",
            url: "{!! route('search.ept_by_date') !!}", // path to function
            dataType: 'JSON',
            data: {
                "_token": "{{ csrf_token() }}",
                "val"  : val,
            },
            success: function(data){
                try{
                    var locationString = '';
                    $.each(data, function (key, value) {
                          locationString += '<option value="' + value.id + '">' + value.ept_time + '</option>';
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
</script>
@endsection
@section('footer')
  @include('isept/footerisept')
@stop
