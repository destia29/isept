@extends('templateiseptunila')

@section('title')
  ISEPT | Add New EPT Room
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Edit EPT Room</h3>
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
                <div class="panel-heading"><h3 class="panel-title">Edit EPT Room</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" role="form" action="{{ route('adminept.eptproperties.editroom.post') }}" method="POST" >
                        {{ csrf_field() }}
                        <input type="hidden" name="id_eptroom" value="{{ $edit->id }}">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Room Name <star>*</star></label>
                            <div class="col-md-4">
                                <input type="text" name="room_name" class="form-control" value="{{ $edit->room_name }}" placeholder="Language Center of Unila 2nd Floor - Room 2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Room Capacity <star>*</star></label>
                            <div class="col-md-4">
                                <input type="text" name="capacity" class="form-control" value="{{ $edit->capacity }}" placeholder="75">
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label"></label>
                          <div class="col-sm-4">
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
@stop
