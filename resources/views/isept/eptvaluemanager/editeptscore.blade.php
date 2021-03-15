@extends('templateiseptunila')

@section('title')
  ISEPT Unila | Edit EPT Score
@endsection
@section('navbarisept')
  @include('isept/eptvaluemanager/navbareptvaluemanager')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Edit EPT Score</h3>
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
            <div class="panel-body">
              <div class="panel-heading"><h3 class="panel-title">Edit EPT Score Form</h3></div>
                <div class="col-sm-5">
                    <form method="POST" action="{{ route('eptvaluemanager.eptscorelist.edit.post') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_score" value="{{ $edit->id }}">
                    <div class="form-horizontal p-20" role="form">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Profile Picture</label>
                              <div class="col-md-6">
                                  <img src="{{ route('eptvaluemanager.eptscorelist.profile_picture', $edit->registerept->eptparticipant->profile_picture) }}" class="media-object thumb-xlg" height="150px" width="128px">
                              </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">NPM/NIK</label>
                            <div class="col-md-5">
                              <input type="text" class="form-control" disabled="" value="{{ $edit->registerept->eptparticipant->idnumber_eptparticipant }}" name="npm_nik">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Full Name</label>
                            <div class="col-md-5">
                              <input type="text" class="form-control" disabled="" value="{{ $edit->registerept->eptparticipant->user->name }}" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Email Address</label>
                            <div class="col-md-7">
                              <input type="text" class="form-control" disabled="" value="{{ $edit->registerept->eptparticipant->user->email }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Faculty / Major</label>
                            <div class="col-md-7">
                            @if($edit->registerept->eptparticipant->id_major != NULL)
                            <input type="text" class="form-control" disabled="" value="{{ $edit->registerept->eptparticipant->major->faculty->faculty_alias }} / {{ $edit->registerept->eptparticipant->major->major_name }}" placeholder="Text" name="name">
                            @else
                            <input type="text" class="form-control" disabled="" value=Public placeholder="Text" name="name">
                            @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Certif Code</label>
                            <div class="col-md-7">
                              <input type="text" class="form-control" disabled="" value="{{ $edit->certif_code }}">
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-sm-5">
                      <div class="form-horizontal p-20" role="form">
                          <div class="form-group">
                              <label class="col-md-3 control-label">EPT Type</label>
                              <div class="col-md-6">
                                  <input type="text" class="form-control" disabled="" value="{{ $edit->registerept->ept->type->type }}" placeholder="Text" name="name">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-3 control-label">Test Date / Time</label>
                              <div class="col-md-6">
                                  <input type="text" class="form-control" disabled="" value="{{ date('d F Y', strtotime($edit->registerept->ept->ept_date)) }} / {{ $edit->registerept->ept->ept_time }}" placeholder="Text" name="name">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-sm-3 control-label">Attempt</label>
                              <div class="col-sm-3">
                                  <input type="text" class="form-control" disabled="" value="{{ $edit->registerept->attempt }}" placeholder="Text" name="name">
                                  </select>
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-3 control-label">Listening Score <star>*</star></label>
                              <div class="col-md-3">
                                  <input type="text" name="listening_score" class="form-control" value="{{ $edit->listening_score }}" placeholder="2 Digits" maxlength="2">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-3 control-label">Structure Score <star>*</star></label>
                              <div class="col-md-3">
                                  <input type="text" name="structure_score" class="form-control" value="{{ $edit->structure_score }}" placeholder="2 Digits" maxlength="2">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-3 control-label">Reading Score <star>*</star></label>
                              <div class="col-md-3">
                                  <input type="text" name="reading_score" class="form-control" value="{{ $edit->reading_score }}" placeholder="2 Digits" maxlength="2">
                              </div>
                          </div>
                          <div class="form-group">
                              <label class="col-md-3 control-label">EPT Score</label>
                              <div class="col-md-3">
                                  <input type="text" name="total_score" class="form-control" value="{{ $edit->total_score }}" placeholder="3 Digits" maxlength="3">
                              </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-1 control-label"></label>
                            <div class="col-md-11">
                              <button type="submit" class="btn btn-purple pull-right">Update Score</button>
                            </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-horizontal p-20" role="form">
                            <div class="form-group">
                                <label class="col-sm-6 control-label">Take Course</label>
                                <div class="col-sm-6">
                                    <select class="form-control" name="take_course">
                                        @if($edit->takecourse == "Yes")
                                            <option value="Yes" selected>Yes</option>
                                            <option value="No">No</option>
                                        @else
                                            <option value="Yes">Yes</option>
                                            <option value="No" selected>No</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                      </div>
                      </form>
                    </div>
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->
    </div> <!-- End row -->
</div>


@stop
@section('footer')
  @include('isept/footerisept')
@stop
