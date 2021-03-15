@extends('templateisclunila')

@section('title')
  ISCLUnila | Change Password
@endsection
@section('navbarisclunila')
    @if(Auth::user()->role->role_name == "Admin LC Unila")
        @include('isclunila/adminclu/navbaradminclu')
    @elseif(Auth::user()->role->role_name == "Chief of the Board")
        @include('isclunila/chiefoftheboard/navbarchiefoftheboard')
    @endif
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Change Password</h3>
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
                <div class="panel-heading"><h3 class="panel-title">Change Password Form</h3></div>
                    <div class="panel-body">
                        @if(Auth::user()->role->role_name == "Admin God")
                            <form class="form-horizontal p-20" action="{{ route('islcunila.changepassword.admingod.edit.post') }}" method="POST">
                        @elseif(Auth::user()->role->role_name == "Admin LC Unila")
                            <form class="form-horizontal p-20" action="{{ route('islcunila.changepassword.adminlcunila.edit.post') }}" method="POST">
                        @elseif(Auth::user()->role->role_name == "Chief of the Board")
                            <form class="form-horizontal p-20" action="{{ route('islcunila.changepassword.chiefoftheboard.edit.post') }}" method="POST">
                        @endif
                        {{ csrf_field() }}
                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                            @if(in_array(Auth::user()->role->role_name, ['Admin LC Unila','Chief of the Board']))
                                NIP
                            @elseif(in_array(Auth::user()->role->role_name, ['Admin God']))
                                NPM
                            @endif
                            </label>
                            <div class="col-md-3">
                                @if(in_array(Auth::user()->role->role_name, ['Admin LC Unila','Chief of the Board']))
                                    <input type="text" name="id_role" class="form-control" value="{{ Auth::user()->adminuser->nip_user }}" disabled>
                                @elseif(in_array(Auth::user()->role->role_name, ['Admin God']))
                                    <input type="text" name="id_role" class="form-control" value="{{ Auth::user()->eptparticipant->idnumber_eptparticipant }}" disabled>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Current Password <star>*</star></label>
                            <div class="col-md-3">
                                <input type="password" name="currentpassword" class="form-control" value="" data-toggle="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">New Password <star>*</star></label>
                            <div class="col-md-3">
                                <input type="password" name="newpassword" class="form-control" value="" data-toggle="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Retype New Password <star>*</star></label>
                            <div class="col-md-3">
                                <input type="password" name="newpassword_confirmation" class="form-control" value="" data-toggle="password">
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label"></label>
                          <div class="col-sm-3">
                            <button type="submit" class="btn btn-info">Submit</button>
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
