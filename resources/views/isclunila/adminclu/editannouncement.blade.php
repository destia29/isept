@extends('templateisclunila')

@section('title')
  ISLCUnila | Edit LCU Announcement
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection

@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Edit Announcement</h3>
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
                <div class="panel-heading"><h3 class="panel-title">Edit Announcement Form</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" role="form" action="{{ route('adminlcu.lcuannouncement.edit.post') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_announcement" value="{{ $edit->id }}">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Announcement Title <star>*</star></label>
                            <div class="col-md-8">
                                <input type="text" name="title" class="form-control" value="{{ $edit->title }}" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="example-email">Announcement Content <star>*</star></label>
                            <div class="col-md-8">
                              <textarea class="summernote" name="description" rows="5">{{ $edit->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Release Date <star>*</star></label>
                            <div class="col-md-8">
                              <div class="input-group">
                                <input type="text" name="release_date" class="form-control" value="{{ date('m/d/Y', strtotime($edit->release_date)) }}" placeholder="mm/dd/yyyy" id="datepicker">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                              </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Posted By</label>
                            <div class="col-md-8">
                                <input type="text" name="posted_by" class="form-control" value="{{ Auth::user()->name }}" placeholder="Announcer Name"  disabled="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Input Tags</label>
                            <div class="col-sm-7">
                                <input name="input_tags" id="tags" class="form-control" value="{{ $edit->tag }}" />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Announcement Thumbnail<br>(*max.1mb)</label>
                              <div class="col-md-7">
                                    <input type="hidden" name="announcement_picture_name" value="{{ $edit->thumbnail }}">

                                    <img src="{{ route('image_announcement', $edit->thumbnail) }}" class="media-object thumb-xlg" height="180px" width="270px">

                                    <input type="file" class="btn btn-default" name="announcement_thumbnail">
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
