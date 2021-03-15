@extends('templateiseptunila')

@section('title')
  ISEPT Unila | View EPT Result
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
    @elseif(Auth::user()->role->role_name == "Chief of the Board")
        @include('isclunila/chiefoftheboard/navbarchiefoftheboard')
    @elseif(Auth::user()->role->role_name == "Admin LC Unila")
        @include('isclunila/adminclu/navbaradminclu')
    @endif
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">View EPT Result</h3>
    </div>

    <div class="row">
        <div class="col-md-12 portlets">
            <!-- Your awesome content goes here -->
            <div class="m-b-30">
              <iframe src="{{ route('isept.streameptresultselected', $name) }}" width="100%" height="700" alt="pdf"></iframe>
            </div>
        </div>
    </div>
</div>




@stop

@section('footer')
  @include('isept/footerisept')
@stop
