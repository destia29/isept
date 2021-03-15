@extends('templateiseptunila')

@section('title')
  ISEPT Unila | EPT Properties
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection
@section('mainisept')


<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">EPT Properties</h3>
    </div>
    <div class="row">
      <div class="col-md-6">
          <div class="panel panel-default">
              <div class="pull-right">
                    <a href="{{ url('isept/adminept/addnewepttype') }}" class="btn btn-block btn-md btn-success">Add Type <i class="fa fa-plus"></i></a>
              </div>
              <div class="panel-heading">
                  <h3 class="panel-title">EPT Type List</h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>EPT Type Code</th>
                                      <th>Type</th>
                                      <th>Cost</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>

                              <tbody>
                                      <?php $i=1; ?>
                                      @foreach($typeproperties as $data)
                        								<tr>
                        									<td>{{ $i++ }}</td>
                        									<td>{{ $data->code }}</td>
                        									<td>{{ $data->type }}</td>
                        									<td>{{ $data->cost }}</td>
                                          <td class="actions" align="center">
                                              <a href="{{ route('adminept.eptproperties.edittype', ['id' => $data->id]) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                              <a href="{{ route('adminept.eptproperties.deletetype', ['id' => $data->id]) }}" class="btn btn-danger btn-xs btn-flat remove"><i class="fa fa-times-circle"></i></a>
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
      <div class="col-md-6">
          <div class="panel panel-default">
              <div class="pull-right">
                    <a href="{{ url('isept/adminept/addneweptroom') }}" class="btn btn-block btn-md btn-success">Add Room <i class="fa fa-plus"></i></a>
              </div>
              <div class="panel-heading">
                  <h3 class="panel-title">EPT Room List</h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <table class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Room</th>
                                      <th>Capacity</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>

                              <tbody>
                                      <?php $i=1; ?>
                                      @foreach($roomproperties as $data)
                        								<tr>
                        									<td>{{ $i++ }}</td>
                        									<td>{{ $data->room_name }}</td>
                        									<td>{{ $data->capacity }}</td>
                                          <td class="actions" align="center">
                                              <a href="{{ route('adminept.eptproperties.editroom', ['id' => $data->id]) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                              <a href="{{ route('adminept.eptproperties.deleteroom', ['id' => $data->id]) }}" class="btn btn-danger btn-xs btn-flat remove"><i class="fa fa-times-circle"></i></a>
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
  </div>
  <div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">EPT Certificate Code</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th align="center">Code</th>
                                    <th align="center">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                    <?php $i=1; ?>
                                    @foreach($codeproperties as $data)
                                      <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $data->code }}</td>
                                        <td class="actions" align="center">
                                            <a href="{{ route('adminept.eptproperties.editcode', ['id' => $data->id]) }}" class="btn btn-warning btn-xs btn-flat"><b>Edit Code </b><i class="fa fa-pencil"></i></a>
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
</div>

@stop

@section('footer')
  @include('isept/footerisept')
@stop
