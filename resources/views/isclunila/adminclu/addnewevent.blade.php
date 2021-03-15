@extends('templateisclunila')

@section('title')
  ISLCUnila | Add New LCU Event
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Add New Event</h3>
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
                <div class="panel-heading"><h3 class="panel-title">Add New Event Form</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" role="form" action="{{ route('event.add') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="col-md-2 control-label">Event Title <star>*</star></label>
                            <div class="col-md-8">
                                <input type="text" name="title" class="form-control" value="" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="example-email">Event Content <star>*</star></label>
                            <div class="col-md-8">
                              <textarea class="summernote" name="description" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Release Date <star>*</star></label>
                            <div class="col-md-8">
                              <div class="input-group">
                                <input type="text" name="release_date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Posted By</label>
                            <div class="col-md-8">
                                <input type="text" name="posted_by" class="form-control" value="{{ Auth::user()->name }}" placeholder="Announcer Name" disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Input Tags</label>
                            <div class="col-sm-7">
                                <input name="input_tags" id="tags" class="form-control" value="admin,dashboard,xyz" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Event Thumbnail<br>(*max.1mb)</label>
                              <div class="col-md-7">
                                  <input type="file" name="event_thumbnail" id="fileToUpload" class="btn btn-default">
                              </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label"></label>
                          <div class="col-sm-8">
                            <button type="submit" class="btn btn-purple pull-left">Submit</button>
                          </div>
                        </div>
                    </form>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div> <!-- End row -->
</div>


@endsection

@section('footer')
  @include('isclunila/footerisclunila')
@endsection
