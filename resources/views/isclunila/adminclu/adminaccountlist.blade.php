@extends('templateisclunila')

@section('title')
  ISCLUnila | Admin Account List
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection
@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">Admin Account List</h3>
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
                                      <th>Name</th>
                                      <th>NIP</th>
                                      <th>Admin Type</th>
                                      <th>Username</th>
                                      <th>Email</th>
                                      <th>Position</th>
                                      <th>Action</th>
                                  </tr>
                              </thead>

                              <tbody>
                                  <?php $i=1; ?>
                                  @foreach($adminuser as $data)
                  								<tr>
                  									<td>{{ $i++ }}</td>
                  									<td>{{ $data->name }}</td>
                  									<td>{{ $data->adminuser->nip_user }}</td>
                  									<td>{{ $data->role->role_name }}</td>
                  									<td>{{ $data->username }}</td>
                  									<td>{{ $data->email }}</td>
                  									<td>{{ $data->adminuser->position }}</td>
                                    <td class="actions">
                                        <a href="{{ route('adminlcu.adminaccountlist.edit', $data->id) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('adminlcu.adminaccountlist.delete', $data->id) }}" class="btn btn-danger btn-xs btn-flat remove"><i class="fa fa-trash-o"></i></a>
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
  @include('isclunila/footerisclunila')
  @include('isclunila/modaldeletedatanotif')
@stop
