@extends('templateisclunila')

@section('title')
  ISCLUnila | LCU Staff
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">LCU Staff</h3>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="input-group">
                        <input type="text" id="example-input1-group2" name="example-input1-group2" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-effect-ripple btn-primary"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 pull-right">
            <div class="panel panel-default pull-right">
                <div class="panel-body">
                    <a href="{{ url('isclunila/adminclu/addnewlcustaff') }}" class="btn btn-block btn-md btn-success">Add Staff <i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>

    </div> <!-- End row -->

    <div class="row">
    <?php $i=1; ?>
    @foreach($lcustaff as $data)
        <div class="col-sm-6">
            <div class="panel">
                <div class="panel-body">
                    <div class="media-main">
                        <input type="hidden" name="lcustaff_picture_name" value="{{ $data->picture }}">
                        <a class="pull-left" href="#">
                            <img class="thumb-lg img-circle bx-s" src="{{ route('image_staff', $data->picture) }}" alt="">
                        </a>
                        <div class="pull-right btn-group-sm">
                            <a href="{{ route('adminlcu.lcustaff.edit', $data->id) }}" class="btn btn-warning btn-xs btn-flat" data-placement="top" data-toggle="tooltip" data-original-title="Edit">
                                <i class="fa fa-pencil"></i>
                            </a>
                            <a href="{{ route('adminlcu.lcustaff.delete', $data->id) }}" class="btn btn-danger btn-xs btn-flat remove" data-placement="top" data-toggle="tooltip" data-original-title="Delete">
                                <i class="fa fa-close"></i>
                            </a>
                        </div>
                        <div class="info">
                            <h4>{{ $data->name }}</h4>
                            <p class="text-muted">{{ $data->position }}</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <hr/>
                    <ul class="social-links list-inline p-b-10">
                        <li>
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="{{ $data->facebook }}" data-original-title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="{{ $data->twitter }}" data-original-title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="{{ $data->googleplus }}" data-original-title="Google" target="_blank"><i class="fa fa-google-plus"></i></a>
                        </li>
                        <li>
                            <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="{{ $data->instagram }}" data-original-title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a>
                        </li>
                    </ul>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- end col -->
          @endforeach
    </div> <!-- End row -->

    <div class="row">
        <div class="col-sm-12">
            <ul class="pagination pull-right">

                {{ $lcustaff->links() }}
            </ul>
        </div>
    </div>
</div>

@stop

@section('footer')
  @include('isclunila/footerisclunila')
@stop
