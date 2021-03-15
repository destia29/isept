@extends('templateisclunila')

@section('title')
  ISEPT | Add New LCU Staff
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Add New LCU Staff</h3>
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
                <div class="panel-heading"><h3 class="panel-title">Add New LCU Staff Form</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" action="{{ route('lcustaff.add') }}" role="form" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{-- <input type="hidden" name="id_ept" value="{{ $edit->id }}"> --}}
                        <div class="form-group">
                            <label class="col-md-2 control-label">Full Name <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="name" class="form-control" placeholder="Full Name, S.Pd.">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Position <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="position" class="form-control" placeholder="Quality Assurance Division">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Facebook <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="facebook" class="form-control" placeholder="https://web.facebook.com/name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Twitter <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="twitter" class="form-control" placeholder="https://twitter.com/name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Google Plus <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="googleplus" class="form-control" placeholder="https://plus.google.com/114159417629266643988">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Instagram <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="instagram" class="form-control" placeholder="https://www.instagram.com/name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Staff Photo <star>*</star><br>(*max.1mb)</label>
                              <div class="col-md-5">
                                  <input type="file" name="staff_photoprofile" id="fileToUpload" class="btn btn-default">
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
