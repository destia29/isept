@extends('templateisclunila')

@section('title')
  ISCLUnila | Service List
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="row">
        <div class="col-lg-8">
                <h3 class="title" style="text-align: left; justify-content: center; vertical-align:middle;">Service List</h3>
        </div>
        <div class="col-lg-4"><br>
            <div class="pull-right">
                  <a href="{{ url('isclunila/adminclu/addnewlcuservice') }}" class="btn btn-block btn-md btn-success">Add Service <i class="fa fa-plus"></i></a>
            </div>
        </div>
    </div> <!-- End row -->
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
                              <th>Kind of Service</th>
                              <th>Quantity</th>
                              <th>Cost</th>
                              <th>Action</th>
                          </tr>
                      </thead>

                      <tbody>
                          <?php $i=1; ?>
                          @foreach($lcservice as $data)
                        <tr class="gradeA">
                            <td>{{ $i++ }}</td>
          									<td>{{ $data->name }}</td>
          									<td>{{ $data->quantity }}</td>
          									<td>{{ $data->modif_cost }}</td>
                            <td class="actions">
                                <a href="{{ route('adminlcu.lcuservice.edit', $data->id) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('adminlcu.lcuservice.delete', $data->id) }}" class="btn btn-danger btn-xs btn-flat remove"><i class="fa fa-trash-o"></i></a>
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
