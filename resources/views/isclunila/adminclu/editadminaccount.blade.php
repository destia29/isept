@extends('templateisclunila')

@section('title')
  ISLCUnila | Edit Admin Account
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Edit Admin Account</h3>
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
                <div class="panel-heading"><h3 class="panel-title">Edit Admin Account Form</h3></div>
                <div class="panel-body">
                    <form class="form-horizontal p-20" role="form" action="{{ route('adminlcu.adminaccountlist.edit.post') }}" method="POST" >
                        {{ csrf_field() }}
                        <input type="hidden" name="id_user" value="{{ $edit->id }}">
                        <input type="hidden" name="id_adminuser" value="{{ $edit->adminuser->id }}">
                        <div class="form-group">
                            <label class="col-md-2 control-label">Name <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="name" class="form-control" value="{{$edit->name }}" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label" for="example-email">Email <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="email" class="form-control" value="{{ $edit->email }}" placeholder="Email Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">NIP <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="nip_user" class="form-control" value="{{ $edit->adminuser->nip_user }}" placeholder="Nomor Induk Pengajar">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Username <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="username" class="form-control" value="{{ $edit->username }}" placeholder="Username">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Password <star>*</star></label>
                            <div class="col-md-5">
                                <input type="password" name="password" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Retype Password <star>*</star></label>
                            <div class="col-md-5">
                                <input type="password" name="password_confirmation" class="form-control" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Admin Type <star>*</star></label>
                            <div class="col-sm-5">
                                <select class="form-control" name="admin_type">
                                    @foreach($role as $data)
                                        <option value="{{ $data->id }}">{{ $data->role_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label">Position <star>*</star></label>
                            <div class="col-md-5">
                                <input type="text" name="position" class="form-control" value="{{ $edit->adminuser->position }}" placeholder="Position">
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
