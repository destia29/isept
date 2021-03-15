@extends('templateisclunila')

@section('title')
  ISLCUnila | Detail LCU Message
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Detail LCU Message</h3>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Sender</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" action="{{ route('adminlcu.lcustaff.edit.post') }}" role="form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Name</label>
                            <div class="col-md-12">
                                <input type="text" name="position" class="form-control" value="{{ $detail->name }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Email</label>
                            <div class="col-md-12">
                                <input type="text" name="position" class="form-control" value="{{ $detail->email }}" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Received</label>
                            <div class="col-md-12">
                                <input type="text" name="facebook" class="form-control" value="{{ date('d F Y, H:i', strtotime($detail->created_at)) }}" readonly>
                            </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
        <div class="col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">{{ $detail->subject }}</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" action="{{ route('adminlcu.lcustaff.edit.post') }}" role="form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Message</label>
                            <div class="col-md-10">
                                <textarea class=form-control rows="9" readonly>{{ $detail->message }}</textarea>
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
