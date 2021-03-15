@extends('templateisclunila')

@section('title')
  ISLCUnila | Message List
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Message List</h3>
    </div>
    <div class="row">
      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">List Table</h3>
              </div>
              <div class="panel-body">
                  <table id="datatable" class="table table-striped table-bordered">
                      <thead>
                          <tr>
                              <th>No</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Subject</th>
                              <th>Time Received</th>
                              <th>Status</th>
                              <th>Action</th>
                          </tr>
                      </thead>

                      <tbody>
                          <?php $i=1; ?>
                          @foreach($lcmessage as $data)
                        <tr class="gradeA">
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->email }}</td>
                            <td>{{ str_limit($data->subject, 80, '.....') }}</td>
                            {{-- <td>{{ date('h:i A, d F Y', strtotime($data->created_at)) }}</td>--}}
                            <td>{{ date('d F Y', strtotime($data->created_at)) }}</td>
                            @if($data->status == "Unread")
                            <td><p style="color:#F5AB35"><b>Unread</b><p></td>
                            @else
                            <td><p style="color:#66CC99">{{ $data->status }}<p></td>
                            @endif
                            <td class="actions">
                                <a href="{{ route('adminlcu.lcumessage.detail', $data->id) }}" class="btn btn-info btn-xs btn-flat"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('adminlcu.lcumessagelist.delete', $data->id) }}" class="btn btn-danger btn-xs btn-flat remove"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                          @endforeach
                      </tbody>
                  </table>
                </div>
                <!-- end: page -->

            </div> <!-- end Panel -->
        </div>
    </div>
</div>
<!-- Page Content Ends -->

@stop

@section('footer')
  @include('isclunila/footerisclunila')
  @include('isclunila/modaldeletedatanotif')
@stop
