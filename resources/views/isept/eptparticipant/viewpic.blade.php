@extends('templateiseptunila')

@section('title')
  ISEPT Unila | View My PIC
@endsection
@section('navbarisept')
  @include('isept/eptparticipant/navbareptparticipant')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">View my E-PIC</h3>
    </div>

    <div class="row">
        <div class="col-md-12 portlets">
            <!-- Your awesome content goes here -->
            <div class="m-b-30">
              <iframe src="{{ route('eptparticipant.myprofile.streampic', $id) }}" width="65%" height="550" alt="pdf"></iframe>
            </div>
        </div>
    </div>
</div>




@stop

@section('footer')
  @include('isept/footerisept')
@stop
