@extends('templateisclunila')

@section('title')
  ISLCUnila | Event List
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Event List</h3>
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
                              <th>Title</th>
                              <th>Content</th>
                              <th>Post Date</th>
                              <th>Posted By</th>
                              <th>Tag</th>
                              <th>Thumbnail</th>
                              <th>Action_Table</th>
                          </tr>
                      </thead>

                      <tbody>
                          <?php $i=1; ?>
                          @foreach($event as $data)
                        <tr class="gradeA">
                            <td>{{ $i++ }}</td>
                            <td>{{ $data->title }}</td>
                            <td>{{ str_limit($data->description, 80, '.....') }}</td>
                            <td>{{ date('d F Y', strtotime($data->release_date)) }}</td>
                            <td>{{ $data->user->name }}</td>
                            <td>{{ $data->tag }}</td>
                            <td>{{ $data->thumbnail }}</td>
                            <td class="actions">
                                <a href="{{ route('event.detail', ['id' => $data->id]) }}" target="_blank" class="btn btn-info btn-xs btn-flat"><i class="fa fa-eye"></i></a>
                                <a href="{{ route('adminlcu.lcuevent.edit', $data->id) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('adminlcu.lcueventlist.delete', $data->id) }}" class="btn btn-danger btn-xs btn-flat remove"><i class="fa fa-trash-o"></i></a>
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
