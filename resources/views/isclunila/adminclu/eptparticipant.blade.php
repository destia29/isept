@extends('templateisclunila')

@section('title')
  ISLCUnila | EPT Participant List
@endsection
@section('navbarisclunila')
  @include('isclunila/adminclu/navbaradminclu')
@endsection

@section('mainisclunila')

<div class="wraper container-fluid">
    <div class="row">
        <div class="col-lg-8">
                <h3 class="title" style="text-align: left; justify-content: center; vertical-align:middle;">EPT Participant List</h3>
        </div>
        <div class="col-lg-4"><br>
            <div class="pull-right">
                  <a href="{{ url('isclunila/adminclu/addneweptparticipant') }}" class="btn btn-block btn-md btn-success">Add EPT Participant <i class="fa fa-plus"></i></a>
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
                  <div class="row">
                    <form action="{{ route('adminlcunila.eptparticipant.change-status') }}" method="POST">
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
                                      <th>Abandoned</th>
                                      <th>Action Table</th>
                                      <th>Status User</th>
                                  </tr>
                              </thead>

                              <!-- <tbody>
                                      <?php $i=1; ?> -->
                                      {{--
                                      @foreach($eptparticipant as $data)
                      								<tr>
                      									<td align="center">{{ $i++ }}</td>
                      									<td>{{ $data->user->name }}</td>
                      									<td>{{ $data->idnumber_eptparticipant }}</td>
                                        @if($data->id_major != NULL)
                      									<td>{{ $data->major->faculty->faculty_name }}</td>
                      									<td>{{ $data->major->major_name }}</td>
                                        @else
                      									<td>-</td>
                      									<td>-</td>
                                        @endif
                      									<td align="center">{{ $data->attempt_participant->count() }}</td>
                      									<td align="center">{{ $data->abandoned_participant->count() }}</td>
                                        <td class="actions" align="center">
                                          <a href="{{ route('adminlcunila.eptparticipant.edit', $data->id) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                          <a href="{{ route('adminlcunila.eptparticipant.resetpassword', $data->id) }}" class="btn btn-inverse btn-xs btn-flat resetpassword"><i class="fa fa-undo"></i></a>
                                          <a href="{{ route('adminlcunila.eptparticipant.suspend', $data->id) }}" class="btn btn-inverse btn-xs btn-flat suspend"><i class="fa fa-pause"></i></a>
                                          <a href="{{ route('adminlcunila.deleteeptparticipant', $data->id) }}" class="btn btn-danger btn-xs btn-flat remove"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                        <td align="center">
                                            @if($data->userstatus == "Active")
                                                <p style="color:green">Active</p>
                                            @else
                                                <p style="color:red">Non-active</p>
                                                <a href="{{ route('adminlcunila.eptparticipant.activate', $data->id) }}" class="btn btn-info btn-xs btn-flat success">
                                                <button type="button" class="btn btn-block btn-info btn-xs m-b-5">Activate</button></a>
                                            @endif
                                        </td>
      								                </tr>
                                      @endforeach
                                      --}}
                              <!-- </tbody> -->
                              <tbody>
                                      <?php $i=1; ?>
                                      @foreach($eptparticipant as $data)
                                      <tr>
                                        <td align="center">{{ $i++ }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->eptparticipant->idnumber_eptparticipant or 'not found'}}</td>

                                        <td>{{ $data->eptparticipant->major->faculty->faculty_name or '-'}}</td>
                                        <td>{{ $data->eptparticipant->major->major_name or '-'}}</td>

                      									<td align="center">{{ $data->eptparticipant->attempt_participant->count() }}</td>
                      									<td align="center">{{ $data->eptparticipant->abandoned_participant->count() }}</td>
                                        <td class="actions" align="center">
                                          <a href="{{ route('adminlcunila.eptparticipant.edit', $data->eptparticipant->id) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                          <a href="{{ route('adminlcunila.eptparticipant.resetpassword', $data->eptparticipant->id) }}" class="btn btn-inverse btn-xs btn-flat resetpassword"><i class="fa fa-undo"></i></a>
                                          <a href="{{ route('adminlcunila.eptparticipant.suspend', $data->eptparticipant->id) }}" class="btn btn-inverse btn-xs btn-flat suspend"><i class="fa fa-pause"></i></a>
                                          <a href="{{ route('adminlcunila.deleteeptparticipant', $data->eptparticipant->id) }}" class="btn btn-danger btn-xs btn-flat remove"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                        <td align="center">
                                            @if($data->eptparticipant->userstatus == "Active")
                                                <p style="color:green">Active</p>
                                            @else
                                                <p style="color:red">Non-active</p>
                                                <a href="{{ route('adminlcunila.eptparticipant.activate', $data->eptparticipant->id) }}" class="btn btn-info btn-xs btn-flat success">
                                                <button type="button" class="btn btn-block btn-info btn-xs m-b-5">Activate</button></a>
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

@section('script')
<script type="text/javascript">
$(function(){
        var table_2 = $("#datatable_2").dataTable();

        $("#checkall").on('click', function () {
            var cells = table_2.api().cells().nodes();
            $( cells ).find('.checkboxclass').prop('checked', this.checked);
        });
    });
</script>
@endsection

@section('footer')
  @include('isclunila/footerisclunila')
@stop
