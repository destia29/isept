@extends('templateisclunila')

@section('title')
  ISEPT Unila | My Profile
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
            <div class="bg-picture" style="background-image:url('{{ asset ('img/bg_6.jpg') }}')">
              <span class="bg-picture-overlay"></span><!-- overlay -->
              <!-- meta -->
              <div class="box-layout meta bottom">
                <div class="col-sm-6 clearfix">
                  <span class="img-wrapper pull-left m-r-15"><img src="{{ route('adminuserphotoprofile_isclunila', Auth::user()->adminuser->profile_picture ) }}" alt="" style="height:68px; width:54px" class="br-radius"></span>
                  <div class="media-body">
                    <h3 class="text-white mb-2 m-t-10 ellipsis">{{ Auth::user()->name }}</h3>
                    <h5 class="text-white"> Lampung</h5>
                  </div>
                </div>
                <div class="col-sm-6">

                  <div class="pull-right">
                    <a class="btn btn-info m-t-20" href="#"></i> Active User</a>
                  </div>
                </div>
              </div>
              <!--/ meta -->
            </div>
        </div>
    </div>

    <div class="row m-t-30">
        <div class="col-sm-12">
            <div class="panel panel-default p-0">
                <div class="panel-body p-0">
                    <ul class="nav nav-tabs profile-tabs">
                        <li class="active"><a data-toggle="tab" href="#aboutme">About Me</a></li>
                        <!-- <li class=""><a data-toggle="tab" href="#user-activities">Activities</a></li> -->
                        <li class=""><a data-toggle="tab" href="#edit-profile">Settings</a></li>
                    </ul>

                    <div class="tab-content m-0">

                        <div id="aboutme" class="tab-pane active">
                        <div class="profile-desk">
                            <h1>{{ Auth::user()->name }}</h1>
                            <span class="designation">
                                {{ Auth::user()->adminuser->position }}</span>
                            <p>
                                Appreciate everything your associates do for the business. Nothing else can quite substitute for a few well-chosen, well-timed, sincere words of praise.<br>They’re absolutely free and worth a fortune.
                            </p>
                            @if(Auth::user()->role->role_name == "Admin LC Unila")
                            <a class="btn btn-primary m-t-20" href="{{ route('adminlcu.neweptscore') }}"></i> See EPT Score</a>
                            @elseif(Auth::user()->role->role_name == "Chief of the Board")
                            <a class="btn btn-primary m-t-20" href="{{ route('chiefoftheboard.neweptscore') }}"></i> See EPT Score</a>
                            @endif

                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th colspan="3"><h3>Contact Information</h3></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>Name</b></td>
                                        <td class="ng-binding">
                                            {{ Auth::user()->name }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Username</b></td>
                                        <td class="ng-binding">
                                            {{ Auth::user()->username }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>NIP</b></td>
                                        <td class="ng-binding">
                                            {{ Auth::user()->adminuser->nip_user }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Email</b></td>
                                        <td class="ng-binding">
                                            {{ Auth::user()->email }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><b>Phone</b></td>
                                        <td class="ng-binding">{{ Auth::user()->adminuser->handphone_number }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Position</b></td>
                                        <td class="ng-binding">
                                            {{ Auth::user()->adminuser->position }}
                                        </a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div> <!-- end profile-desk -->
                    </div> <!-- about-me -->


                    <!-- Activities -->
                    <div id="user-activities" class="tab-pane">
                        <div class="timeline-2">
                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">5 minutes ago</div>
                                    <p><strong><a href="#" class="text-info">John Doe</a></strong> Uploaded a photo <strong>"DSC000586.jpg"</strong></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">30 minutes ago</div>
                                    <p><a href="#" class="text-info">Lorem</a> commented your post.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">59 minutes ago</div>
                                    <p><a href="#" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">5 minutes ago</div>
                                    <p><strong><a href="#" class="text-info">John Doe</a></strong>Uploaded 2 new photos</p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">30 minutes ago</div>
                                    <p><a href="#" class="text-info">Lorem</a> commented your post.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>

                            <div class="time-item">
                                <div class="item-info">
                                    <div class="text-muted">59 minutes ago</div>
                                    <p><a href="#" class="text-info">Jessi</a> attended a meeting with<a href="#" class="text-success">John Doe</a>.</p>
                                    <p><em>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam laoreet tellus ut tincidunt euismod. "</em></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- settings -->
                    <div id="edit-profile" class="tab-pane">
                        <div class="user-profile-content">
                            @if(Auth::user()->role->role_name == "Admin LC Unila")
                                <form role="form" action="{{ route('islcunila.myprofile.adminlcunila.edit.post') }}" method="POST" enctype="multipart/form-data">
                            @elseif(Auth::user()->role->role_name == "Chief of the Board")
                                <form role="form" action="{{ route('islcunila.myprofile.chiefoftheboard.edit.post') }}" method="POST" enctype="multipart/form-data">
                            @endif
                                {{ csrf_field() }}
                            <input type="hidden" name="id_user" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="id_adminuser" value="{{ Auth::user()->adminuser->id }}">
                                <div class="form-group">
                                    <label for="FullName">Full Name</label>
                                    <input type="text" name="name" value="{{Auth::user()->name}}" id="Name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Username">Username</label>
                                    <input type="text" name="username" value="{{ Auth::user()->username }}" id="Username" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Nip">NIP</label>
                                    <input type="text" value="{{ Auth::user()->adminuser->nip_user }}" id="Nip" class="form-control" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" name="email" value="{{ Auth::user()->email }}" id="Password" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Phone Number">Phone Number</label>
                                    <input type="text" name="handphone_number" value="{{ Auth::user()->adminuser->handphone_number }}" id="handphone_number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Position">Position</label>
                                    <input type="text" name="position" value="{{ Auth::user()->adminuser->position }}" id="RePassword" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="Photo Profile">Photo Profile</label>
                                        <input type="hidden" name="adminuser_picture_name" value="{{ Auth::user()->adminuser->profile_picture }}">

                                        <img src="{{ route('adminuserphotoprofile_isclunila', Auth::user()->adminuser->profile_picture) }}" class="media-object thumb-xlg" height="127px" width="100px">

                                        <input type="file" class="btn btn-default" name="adminuser_photoprofile">
                                </div>
                                <button class="btn btn-primary" type="submit">Update Profile</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>



</div>


@stop

@section('footer')
  @include('isclunila/footerisclunila')
@stop
