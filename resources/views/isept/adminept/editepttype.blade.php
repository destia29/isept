@extends('templateiseptunila')

@section('title')
  ISEPT | Add New EPT Type
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Edit EPT Type</h3>
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
                <div class="panel-heading"><h3 class="panel-title">Edit EPT Type</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" role="form" action="{{ route('adminept.eptproperties.edittype.post') }}" method="POST" >
                        {{ csrf_field() }}
                        <input type="hidden" name="id_epttype" value="{{ $edit->id }}">
                        <div class="form-group">
                            <label class="col-md-2 control-label">EPT Type Code <star>*</star></label>
                            <div class="col-md-4">
                                <input type="text" name="code" class="form-control" value="{{ $edit->code }}" placeholder="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">EPT Type <star>*</star></label>
                            <div class="col-md-4">
                                <input type="text" name="type" class="form-control" value="{{ $edit->type }}" placeholder="EPT for S1/D3">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">EPT Cost <star>*</star></label>
                            <div class="col-md-4">
                                <input type="text" name="cost" class="form-control" value="{{ $edit->cost }}" placeholder="25000">
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
