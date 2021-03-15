@extends('templateiseptunila')

@section('title')
  ISEPT | EPT Schedule List
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection
@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
      @if($vardatein1 != NULL)
        <h3 class="title">EPT Schedule List</h3>
      @else
        @if($vardatein1 == NULL)
        <h3 class="title">EPT Schedule List on {{ $vardate }}</h3>
        @else
        <h3 class="title">EPT Schedule List on {{ $vardatein1 }} - {{ $vardatein2 }}</h3>
        @endif
      @endif
    </div>
    <div class="row">
      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">List Table</h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <table id="datatable" class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Test Type</th>
                                      <th>Test Date</th>
                                      <th>Test Time</th>
                                      <th>Room (Capacity)</th>
                                      <th>Registration Date</th>
                                      <th>Participant</th>
                                      <th>Registered</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>

                              <tbody>
                                      <?php $i=1; ?>
                                        @foreach($ept as $data)
                        								<tr>
                        									<td>{{ $i++ }}</td>
                        									<td>{{ $data->type->type }}</td>
                        									<td>{{ date('d F Y', strtotime($data->ept_date)) }}</td>
                        									<td align="center">{{ $data->ept_time }}</td>
                        									<td>
                                            @foreach($data->availableseat as $value)
                                              {{ $value->room->room_name }} ({{$value->room->capacity}}),
                                            @endforeach
                                          </td>
                        									<td>{{ date('d F Y', strtotime($data->registration_date)) }}</td>
                        									<td>{{ $data->registerept_participant->count() }}</td>
                        									<td>{{ $data->registerept_registered->count() }}</td>
                                        <td class="actions" align="center">
                                          @if($data->ept_date >= $ept_datedeadline)
                                            <a href="{{ route('adminept.eptschedulelist.edit', ['id' => $data->id]) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('adminept.eptschedulelist.delete', $data->id) }}" class="btn btn-danger btn-xs btn-flat remove"><i class="fa fa-trash-o"></i></a>
                                          @else
                        									-
                                          @endif
                                        </td>
                        								</tr>
                                      @endforeach
                              </tbody>
                          </table>

                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div> <!-- End Row -->
</div>


@stop

@section('footer')
  @include('isept/footerisept')
  @include('isept/modaldeletedatanotif')
@stop
