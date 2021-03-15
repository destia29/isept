@extends('templateisclunila')

@section('title')
  ISLCUnila | Edit LCU Staff
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Edit LCU Service</h3>
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
                <div class="panel-heading"><h3 class="panel-title">Edit LCU Service Form</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" action="{{ route('adminlcu.lcuservice.edit.post') }}" role="form" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_service" value="{{ $edit->id }}">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Kind of Service <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="name" class="form-control" value="{{ $edit->name }}" placeholder="Each Person/Test">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Quantity <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="quantity" class="form-control" value="{{ $edit->quantity }}" placeholder="Full Name, S.Pd.">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Cost <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="cost" class="form-control" value="{{ $edit->cost }}" placeholder="150000">
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
  @include('isclunila/footerisclunila')
@stop
