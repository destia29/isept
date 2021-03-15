@extends('templateiseptunila')

@section('title')
  ISEPT | EPT Certificate List
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection

@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        <h3 class="title">EPT Participant List</h3>
    </div>
    <div class="row">
      <div class="col-md-12">
          <div class="panel panel-default">
              <div class="panel-heading">
                  <h3 class="panel-title">List Table</h3>
              </div>
              <div class="panel-body">
                  <div class="row">
                      {{ csrf_field() }}
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <table id="datatable" class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th>No</th>
                                      <th>Name</th>
                                      <th>NPM/NIK</th>
                                      <th>Faculty</th>
                                      <th>Major</th>
                                      <th>Attempt</th>
                                      <th>Test Date</th>
                                      <th>Test Time</th>
                                      <th>Room</th>
                                      <th>Registration Date</th>
                                      <th>Action</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>

                              <tbody>
                                      <?php $i=1; ?>
                                      @foreach($eptcertificate as $data)
                      								<tr>
                      									<td>{{ $i++ }}</td>
                      									<td>{{ $data->user_name }}</td>
                      									<td>{{ $data->eptpart_idnumber }}</td>
                                        @if($data->id_major != NULL)
                      									<td>{{ $data->faculty_name }}</td>
                      									<td>{{ $data->major_name }}</td>
                                        @else
                      									<td>-</td>
                      									<td>-</td>
                                        @endif
                      									<td align="center">{{ $data->attempt }}</td>
                      									<td>{{ date('d F Y', strtotime($data->ept_eptdate)) }}</td>
                      									<td align="center">{{ $data->ept_epttime }}</td>
                      									<td>{{ $data->room_name }}</td>
                      									<td>{{ date('d F Y', strtotime($data->ept_registrationdate)) }}</td>
                                        <td class="actions" align="center">
                                            <a href="{{ route('adminept.eptcertificate.edit', ['id' => $data->reg_id]) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                        </td>
                                        <td align="center">
                                            @if($data->status == "Done")
                                                <p style="color:#446CB3">Done</p>
                                            @else
                                                <p style="color:#E87E04">Verified</p>
                                                <a href="{{ route('adminept.eptcertificate.finish', $data->reg_id) }}" class="btn btn-info btn-xs btn-flat success">
                                                <button type="button" class="btn btn-block btn-info btn-xs m-b-5">Finish</button></a>
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

@endsection

@section('footer')
  @include('isept/footerisept')
@stop
