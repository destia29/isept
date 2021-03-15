@extends('templateisclunila')

@section('title')
  ISLCUnila | Edit EPT Participant
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">EPT Participant</h3>
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
              <div class="panel-heading"><h3 class="panel-title">Edit EPT Participant Form</h3></div>
                  <div class="col-sm-6">
                    <form method="POST" action="{{ route('adminlcunila.eptparticipant.edit.post') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_eptparticipant" value="{{ $edit->id }}">
                    <input type="hidden" name="id_userparticipant" value="{{ $edit->user->id }}">
                    <div class="form-horizontal p-20" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label">NPM/NIK</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" value="{{ $edit->idnumber_eptparticipant }}" name="idnumber_eptparticipant">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Username</label>
                            <div class="col-md-6">
                              <input type="text" class="form-control" value="{{ $edit->user->username }}" placeholder="username" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Full Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="{{ $edit->user->name }}" placeholder="Nama" name="name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Status <star>*</star></label>
                            <div class="col-md-6">
                                <select class="form-control" name="userstatus">
                                    @if($edit->userstatus == "Active")
                                    <option value="Active" selected>{{ $edit->userstatus }}</option>
                                    <option value="Nonactive">Nonactive</option>
                                    @elseif($edit->userstatus == "Nonactive")
                                    <option value="Nonactive" selected>{{ $edit->userstatus }}</option>
                                    <option value="Active">Active</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                          <div class="col-md-9 control-label">
                              <input type="checkbox" required>
                              <i class="fa"></i>
                              Be Careful whenever you change the status
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 control-label"></label>
                          <div class="col-sm-5">
                            <button type="submit" class="btn btn-purple pull-left">Update</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
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
  @include('isclunila/footerisclunila')
@stop
