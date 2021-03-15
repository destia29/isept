@extends('templateiseptunila')

@section('title')
  ISEPT Unila | Change Password
@endsection
@section('navbarisept')
    @if(Auth::user()->role->role_name == "Admin God")
        @include('isept/admingod/navbaradmingod')
    @elseif(Auth::user()->role->role_name == "Admin EPT")
        @include('isept/adminept/navbaradminept')
    @elseif(Auth::user()->role->role_name == "EPT Value Manager")
        @include('isept/eptvaluemanager/navbareptvaluemanager')
    @elseif(Auth::user()->role->role_name == "Admin Dekanat")
        @include('isept/admindekanat/navbaradmindekanat')
    @elseif(Auth::user()->role->role_name == "EPT Participant")
        @include('isept/eptparticipant/navbareptparticipant')
    @endif
@endsection
@section('mainisept')

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
                            <form class="form-horizontal p-20" action="{{ route('isept.changepassword.admingod.edit.post') }}" method="POST">
                        @elseif(Auth::user()->role->role_name == "Admin EPT")
                            <form class="form-horizontal p-20" action="{{ route('isept.changepassword.adminept.edit.post') }}" method="POST">
                        @elseif(Auth::user()->role->role_name == "EPT Value Manager")
                            <form class="form-horizontal p-20" action="{{ route('isept.changepassword.eptvaluemanager.edit.post') }}" method="POST">
                        @elseif(Auth::user()->role->role_name == "Admin Dekanat")
                            <form class="form-horizontal p-20" action="{{ route('isept.changepassword.admindekanat.edit.post') }}" method="POST">
                        @elseif(Auth::user()->role->role_name == "EPT Participant")
                            <form class="form-horizontal p-20" action="{{ route('isept.changepassword.eptparticipant.edit.post') }}" method="POST">
                        @endif
                        {{ csrf_field() }}
                        <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label class="col-md-2 control-label">
                            @if(in_array(Auth::user()->role->role_name, ["Admin EPT","EPT Value Manager","Admin Dekanat"]))
                                NIP
                            @elseif(in_array(Auth::user()->role->role_name, ["EPT Participant"]))
                                @if(Auth::user()->eptparticipant->id_major != NULL)
                                    NPM
                                @else
                                    NIK
                                @endif
                            @endif
                            </label>
                            <div class="col-md-3">
                                @if(in_array(Auth::user()->id_role, [3,4,5]))
                                    <input type="text" name="id_role" class="form-control" value="{{ Auth::user()->adminuser->nip_user }}" disabled>
                                @elseif(in_array(Auth::user()->id_role, [7]))
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
