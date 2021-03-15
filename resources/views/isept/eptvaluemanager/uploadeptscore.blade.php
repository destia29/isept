@extends('templateiseptunila')

@section('title')
  ISEPT Unila | EPT Score
@endsection
@section('navbarisept')
  @include('isept/eptvaluemanager/navbareptvaluemanager')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Upload EPT Score</h3>
    </div>

    <div class="row">
        <div class="col-md-12 portlets">
            <!-- Your awesome content goes here -->
            <div class="m-b-30">
                <form action="#" class="dropzone" id="dropzone">
                  <div class="fallback">
                    <input name="file" type="file" multiple />
                  </div>
                </form>
            </div>
        </div>
    </div>
</div>




@stop

@section('footer')
  @include('isclunila/footerisclunila')
@stop
