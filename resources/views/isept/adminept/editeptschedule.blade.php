@extends('templateiseptunila')

@section('title')
  ISEPT | Edit EPT Schedule
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Edit EPT Schedule</h3>
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
                <div class="panel-heading"><h3 class="panel-title">Edit EPT Schedule Form</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" method="POST" action="{{ route('adminept.eptschedulelist.edit.post') }}" role="form">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_ept" value="{{ $edit->id }}">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Test Type <star>*</star></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="test_type">
                                    @foreach($type as $value)
                                        @if($value->id == $edit->id_epttype)
                                            <option value="{{ $value->id }}" selected>{{ $value->type }}</option>
                                        @else
                                            <option value="{{ $value->id }}">{{ $value->type }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Test Date <star>*</star></label>
                            <div class="col-md-5">
                              <div class="input-group">
                                <input type="text" name="ept_date" class="form-control" value="{{ date('m/d/Y', strtotime($edit->ept_date)) }}" id="datepicker">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-2 control-label">Test Time <star>*</star></label>
                          <div class="col-md-5">
                            <div class="input-group">
                                <div class="bootstrap-timepicker"><input id="timepicker2" value="{{ $edit->ept_time }}" type="text" name="ept_time" class="form-control"/></div>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                            </div><!-- input-group -->
                          </div>
                        </div>
                        <div class="form-group last">
                            <label class="col-md-2 control-label">Room <star>*</star></label>
                            <div class="col-md-5">
                                <select name="ept_room[]" class="multi-select" multiple="" id="my_multi_select3" >
                                    @foreach($edit->availableseat as $data)
                                        <option value="{{ $data->id }}" selected>{{ $data->room->room_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Registration Date <star>*</star></label>
                            <div class="col-md-5">
                              <div class="input-group">
                                <input type="text" name="registration_date" class="form-control" value="{{ date('d F Y', strtotime($edit->registration_date)) }}" id="datepicker-multiple">
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
