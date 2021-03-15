@extends('templateiseptunila')

@section('title')
  ISEPT | EPT Participant List
@endsection
@section('navbarisept')
  @include('isept/adminept/navbaradminept')
@endsection

@section('mainisept')

<div class="wraper container-fluid">
    <div class="page-title">
        @if($page != 'findparticipant')
        <h3 class="title">EPT Participant List</h3>
        @else
        <h3 class="title">EPT Participant List On </h3>
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
                    <form action="{{ route('adminept.eptparticipant.change-status') }}" method="POST">
                      {{ csrf_field() }}
                      <div class="col-md-12 col-sm-12 col-xs-12">
                          <table id="datatable_2" class="table table-striped table-bordered">
                              <thead>
                                  <tr>
                                      <th data-orderable="false" align="center">All <input type="checkbox" id="checkall" ></th>
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
                                      @foreach($eptparticipant as $data)
                      								<tr>
                                        @if($data->status == "Verified" || $data->status == "Abandoned" || $data->status == "Done")
                      									<td align="center"></td>
                                        @else
                      									<td align="center"><input type="checkbox" class="checkboxclass" name="reg_id[]" value="{{ $data->reg_id }}"></td>
                                        @endif
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
                                            @if($data->status == "Done")
                                            -
                                            @elseif($data->status == "Abandoned" || $data->status == "Verified")
                                            <a href="{{ route('adminept.eptparticipant.edit', ['id' => $data->reg_id]) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                            @elseif($data->status == "Unverified")
                                            <a href="{{ route('adminept.eptparticipant.edit', ['id' => $data->reg_id]) }}" class="btn btn-warning btn-xs btn-flat"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('adminept.eptparticipant.abandoned', ['id' => $data->reg_id]) }}" class="btn btn-danger btn-xs btn-flat abandoned"><i class="fa fa-times-circle"></i></a>
                                            @endif

                                        </td>
                                        <td align="center">
                                            @if($data->status == "Verified")
                                                <p style="color:green">Verified</p>
                                            @elseif($data->status == "Abandoned")
                                                <p style="color:red">Abandoned</p>
                                            @elseif($data->status == "Done")
                                                <p style="color:green">Done</p>
                                            @else
                                                <p style="color:red">Unverified</p>
                                                <a href="{{ route('adminept.eptparticipant.verify', $data->reg_id) }}" class="btn btn-info btn-xs btn-flat success verify">
                                                <button type="button" class="btn btn-block btn-info btn-xs m-b-5">Verify</button></a>
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
  <div class="row">
    <div class="col-md-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Change Multiple Status Data to</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6 pull-left">
                    <button type="submit" name="type_status" value="Abandoned" class="btn btn-block btn-md btn-danger">Abandon <i class="fa fa-times"></i></button>
                </div>
                  <div class="col-lg-6 pull-right">
                      <button type="submit" name="type_status" value="Verified" class="btn btn-block btn-md btn-info success">Verify <i class="fa fa-check"></i></button>
                  </div>
                  </form>
              </div>
            </div>
        </div>
    </div>
  </div>

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
  @include('isept/footerisept')
  @include('isept/modaldeletedatanotif')
@stop
