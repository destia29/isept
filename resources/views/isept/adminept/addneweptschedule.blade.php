@extends('templateiseptunila')

@section('title')
  ISEPT | Add New EPT Schedule
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Add New EPT Schedule</h3>
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
                <div class="panel-heading"><h3 class="panel-title">Add New EPT Schedule Form</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" role="form" action="{{ route('eptschedule.add') }}" method="POST" >
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-sm-2 control-label">EPT Certificate Code</label>
                            <div class="col-md-5">
                              @if($code->code == "" || $code->code == NULL)
                                <input type="text" name="code" class="form-control" value="Please Insert EPT Certificate Code in EPT Properties Menu" disabled style="background-color:#d35400; color:white;">
                              @else
                                <input type="hidden" name="ept_code" value="1">
                                <input type="text" name="code" class="form-control" value="{{ $code->code }}" disabled>
                              @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Test Type <star>*</star></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="test_type" id="id_test_type">
                                    @foreach($type as $data)
                                        <option value="{{ $data->id }}">{{ $data->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Test Date <star>*</star></label>
                            <div class="col-md-5">
                              <div class="input-group">
                                <input type="text" name="ept_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Test Time <star>*</star></label>
                          <div class="col-md-5">
                            <div class="input-group">
                                <div class="bootstrap-timepicker"><input id="timepicker2" type="text" name="ept_time" class="form-control"/></div>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                            </div><!-- input-group -->
                          </div>
                        </div>
                        <div class="form-group last">
                            <label class="col-md-2 control-label">Room <star>*</star></label>
                            <div class="col-md-5">
                                <select name="ept_room[]" class="multi-select" multiple id="multi-select-david" >

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Registration Date <star>*</star></label>
                            <div class="col-md-5">
                              <div class="input-group">
                                <input type="text" name="registration_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker-multiple">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div><!-- input-group -->
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label"></label>
                          <div class="col-sm-5">
                            <button type="submit" class="btn btn-purple pull-left">Submit</button>
                          </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div> <!-- End row -->
</div>


@stop

@section('footer')
  @include('isept/footerisept')
  @include('isept/modaldeletedatanotif')
@stop

@section('script')
<script type="text/javascript">
    $(document).ready(function() {
      $('#multi-select-david').multiSelect();
      $(document).on('change', '#timepicker2, #datepicker, #id_test_type',function(e){
        var test_time = $('#timepicker2').val();
        var id_ept_type = $('#id_test_type').val();
        var test_date = $('#datepicker').val();

        e.preventDefault();

         $.ajax({
           type: "POST",
           url: "{!! route('eptschedule.get-room') !!}", // path to function
           dataType: 'JSON',
           data: {
               "_token": "{{ csrf_token() }}",
               "time"  : test_time,
               "date"  : test_date,
               "ept_type"  : id_ept_type
         },
         success: function(data){
           try{
             var locationString = '';
             $.each(data, function (key, value) {
                  locationString += '<option value="' + value.id + '">' + value.room_name + '</option>';
             });
             $('#multi-select-david').html(locationString);
             $('#multi-select-david').multiSelect('refresh');
           }catch(e) {
             alert('Exception while request..'+e);
           }
         },
       });

      });
    });
</script>
@endsection
